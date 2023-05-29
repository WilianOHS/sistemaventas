<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function username()
    {
        $loginValue = request()->input('login');
        $field = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$field => $loginValue]);

        return $field;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Verificar si el usuario o correo electrónico existe en la base de datos
        $userExists = $this->isEmailExists($request->input('login'));

        if (!$userExists) {
            $errors[$this->username()] = 'Usuario o correo electrónico incorrecto.';
        } else {
            $errors['password'] = 'Contraseña incorrecta.';
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    protected function isEmailExists($login)
    {
        return filter_var($login, FILTER_VALIDATE_EMAIL)
            ? User::where('email', $login)->exists()
            : User::where('username', $login)->exists();
    }
}

