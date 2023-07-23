<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sale;
use App\Purchase;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:users.create')->only(['create','store']);
        $this->middleware('can:users.index')->only(['index']);
        $this->middleware('can:users.edit')->only(['edit','update']);
        $this->middleware('can:users.show')->only(['show']);
        $this->middleware('can:users.destroy')->only(['destroy']);
    }
    public function index()
    {
        $users = User::get();
        return view('admin.user.index',compact('users'));
    }
    public function create()
    {
        $roles = Role::get();
        return view('admin.user.create',compact('roles'));
    }
    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->update(['password'=>Hash::make($request->password)]);
        $user->roles()->sync($request->get('roles'));
        return redirect()->route('users.index');
    }
    public function show(User $user)
    {
        $sales = Sale::where('user_id', $user->id)->get(); // Obtener las ventas del usuario actual
        $purchases = Purchase::where('user_id', $user->id)->get(); // Obtener las compras del usuario actual
    
        return view('admin.user.show', compact('user', 'sales', 'purchases'));
    }
    public function edit(User $user)
    {
        $roles = Role::get();
        return view('admin.user.edit',compact('user','roles'));
    }
   

public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,'.$user->id,
        'email' => 'string|email|max:255|unique:users,email,'.$user->id,
        'password' => 'nullable|string|min:8', // Elimina la regla de confirmación ya que no se necesita aquí
    ]);

    $user->name = $request->input('name');
    $user->username = $request->input('username');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password')); // Encriptar la contraseña nueva antes de actualizar
    }

    $user->save();
    $user->roles()->sync($request->get('roles'));

    return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
}

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
