@extends('layout')

@section('cdns')
    <link rel="stylesheet" href="{{ asset('css/asignarPac.css') }}">
@endsection

@section('content')
    @php
        error_reporting(0);
    @endphp
    <section>
        <a href="{{ route('verMisTurnos') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Resultados para: </h1>
            
            @if($fecha)
                <p style='text-align:center;font-weight:bold;'> Fecha: {{ $fecha }}</p>
                @else
                    @if($dni)
                        <p style='text-align:center;font-weight:bold;'> DNI: {{ $dni }}</p>
                    @endif
            @endif
            
        <div class="tabla-cotainer">
            <table class="tabla">
                <thead>
                    <tr>
                        <th colspan="3" class="cabeza-tabla">Resultados de busqueda</th>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre y Apellido</th>
                        <th>Mas</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ( $turnos as $turno )
                        <tr>
                            <td> {{ $turno->fecha }}</td>
                            <td> {{ $turno->nombre }} {{ $turno->apellido }} </td>
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