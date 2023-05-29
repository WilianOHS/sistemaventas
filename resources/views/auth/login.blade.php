@extends('layouts.login')
@section('content')

<form class="pt-3" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="login"><h5>Nombre de Usuario o Correo Electrónico</h5></label>
        <div class="input-group">
            <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                    <i class="fa fa-user" style="color:silver"></i>
                </span>
            </div>
            <input id="login" type="text" name="login" class="form-control form-control-lg border-left-0 @error('login') is-invalid @enderror" placeholder="Nombre de usuario o correo electrónico" style="HEIGHT: 49px" required>
            @error('login')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="password"><h5>Contraseña</h5></label>
        <div class="input-group">
            <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                    <i class="fa fa-lock" style="color:silver"></i>
                </span>
            </div>
            <input id="password" type="password" name="password" class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror" placeholder="Contraseña" style="HEIGHT: 49px" required>   
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror                  
        </div>
    </div>
    <p class="mt-2">
    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
</p>

    <div class="my-2 d-flex justify-content-between align-items-center">
    </div>
    <div class="my-3">
        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">INICIAR SESIÓN</button>
    </div>
    
</form>
@endsection
