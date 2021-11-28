@extends('layout')

@section('cdns')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section>
        <div class="login-contenedor">
            <h1><i class="fas fa-users icono-users"></i>Iniciar sesion</h1>
            <div class="login-form">
                <form action="{{ route('login.confirm') }}" method="POST">
                    @csrf
                    <div>
                        <input type="text" placeholder="Usuario" name="usuario" value="{{ old('usuario') }}"> 
                        <input type="password" placeholder="Contraseña" name="clave" value="{{ old('clave') }}">                        
                    </div>
                    @error('usuario')
                        <small style="color:red">*{{$message}}</small>
                    @enderror
                    @error('clave')
                        <small style="color:red">*{{$message}}</small>
                    @enderror
                    @error('error')
                        <small style="color:red;">* usuario o contraseña incorrectos</small>
                    @enderror
                    <button type="submit" name="btn-login">Iniciar sesion</button>
                </form>
            </div>
        </div>
    </section>
@endsection