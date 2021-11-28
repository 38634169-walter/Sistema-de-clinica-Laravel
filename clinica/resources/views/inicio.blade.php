@extends('layout')

@section('cdns')

@endsection
    <link href="{{ asset('css/inicio.css') }}" rel="stylesheet">
@section('content')
<section>
    <div class="menu-responsive-container">
        <h1>Menu</h1><i class="fas fa-bars icono-menu"></i><i style="display:none;" class="fas fa-times x-icono"></i>
    </div>
    <div class="body-container">
        <nav class="menu-container">
            <h1><i class="fas fa-user"></i>{{ session('nombreUsu') }}</h1>
            @if(session('cargoUsu')=='Secretaria')
                <ul>
                    <li><i class='far fa-calendar-plus'></i><a href='{{ route('asignarPaciente') }}'>Reservar turno</a></li>
                    <li><i class='fas fa-clipboard-list'></i><a href='{{ route('listaTurnos.show') }}'>Ver lista de turnos</a></li>
                    <li><i class='fas fa-user-plus'></i><a href='{{ route('registrarPaciente') }}'>Registrar paciente</a></li>
                </ul>
            @endif
            
            
            @if(session('cargoUsu')=='Doctor')
                <ul>
                    <li><i class='far fa-address-card'><a href="{{ route('verPacientes') }}"></i>Ver Pacientes</a></li>
                    <li><i class='fas fa-clipboard-list'><a href="{{ route('verMisTurnos') }}"></i>Mis turnos</a></li>
                </ul>
            @endif
            <ul>
                <li id="cerrar"><i class="fas fa-sign-out-alt"></i><a href="{{ route('usuario.destroy') }}">Cerrar sesion</a></li>
            </ul>
        </nav>
        <div class="right-side">
            <div>
                <p>Bienvenido/a: <strong id="nom-usuario">{{ session('nombreUsu') }}</strong></p> 
            </div>
            <ul class="cuerpo-logo">
                <h1>Clinica Riobam</h1>
                <div>
                    <i class="fas fa-user-md"></i>
                    <i class="fas fa-hospital-alt"></i>
                    <i class="fas fa-heartbeat"></i>
                </div>
            </ul>
        </div>
    </div>
    <script src="{{ asset('js/menuu.js') }}"></script>
</section>
@endsection