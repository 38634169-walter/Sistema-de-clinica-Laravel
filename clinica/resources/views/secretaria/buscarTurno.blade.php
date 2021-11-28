@extends('layout')

@section('cdns')
    <link rel="stylesheet" href="{{ asset('css/asignarPac.css') }}">
@endsection

@section('content')
    
    <a href="{{ route('listaTurnos.show') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Resultados para: </h1>
        @php
            error_reporting(0);
        @endphp
    
        @if($dni)
            <p style='text-align:center;font-weight:bold;'> DNI: {{$dni}}</p>
        @endif

        @if($fecha)
            <p style='text-align:center;font-weight:bold;'> Fecha: {{$fecha}}</p>; 
        @endif
        





    <div class="tabla-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th colspan="3" class="cabeza-tabla">Ultimos turnos dados</th>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre y Apellido</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($datos as $dato)
                <tr>
                    <td>{{$dato->fecha}}</td>
                    <td>{{$dato->nombre}} {{$dato->apellido}}</td>
                    <td>
                        <li><a href="{{ route('listaTurnos.turnoInfo',$dato->id) }}"style='text-decoration:none;padding:5px;text-align:center;color:white;background:green;border-radius:10px;'><i class='far fa-eye'></i></a></li>
                    </td>
                </tr>
            @endforeach
            
            @if(empty($datos[0]))
                <tr>
                    <td colspan="3">
                        <li><p>No hay resultados para la busqueda</p></li>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection