@extends('layout')

@section('cdns')
    <link rel="stylesheet" href="{{ asset('css/asignarPac.css') }}">
@endsection

@section('content')
    @php
        error_reporting(0);
    @endphp
    <section>
        <a href="{{ route('inicio') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Mis turnos</h1>
        <br>
        <h3 class="titulo-medio">Buscar turno por:</h3>
        <form class="form-split" action="{{ route('buscarTurnoDoctor') }}" method="POST">
            @csrf
            <div class="form-split">
                <li><label>DNI: </label><input type="number" min="1" name="dni" placeholder="DNI" values="{{ old('dni') }}"></li>    
                <li><label>Fecha: </label><input type="date" name="fecha" placeholder="Fecha" value="{{ old('fecha') }}"></li>        
                <button type="submit" class="btn btn-success boton-guardar">Buscar</button>
            </div>
            @error('dni')
                <small style="color:red">*Se debe agregar al menos un dato de busqueda</small>
            @enderror
            @error('fecha')
                <small style="color:red">*Se debe agregar al menos un dato de busqueda</small>
            @enderror
        </form>
        <h3 class="titulo-medio">Pacientes:</h3>
        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th colspan="3" class="cabeza-tabla">Mis Turnos</th>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre y Apellido</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ( $turnos as $turno )
                        <tr>
                            <td>{{ $turno->fecha }}</td>
                            <td>{{ $turno->nombre }} {{ $turno->apellido }}</td>
                            <td>
                                <li><a href="{{ route('verTurnoDoctor',$turno->turnosID) }}" style='text-decoration:none;padding:5px;text-align:center;color:white;background:green;border-radius:10px;'><i class='far fa-eye'></i></a></li>
                            </td>
                        </tr>
                    @endforeach
                    @if($noHayTurnos)
                        <tr>
                            <td colspan="3">No hay turnos</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </section>
@endsection
