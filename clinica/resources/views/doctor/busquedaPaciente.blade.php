@extends('layout')

@section('cdns')
    <link rel="stylesheet" href="{{ asset('css/asignarPac.css') }}">
@endsection

@section('content')
    <section>
        <a href="{{ route('verPacientes') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Resultados para: </h1>
            @php
                error_reporting(0);
            @endphp
            @if($dni)
                <p style='text-align:center;font-weight:bold;'><strong style="color:white;">DNI: </strong> {{ $dni }}</p>
                @else
                    @if($nombre)
                        <p style='text-align:center;font-weight:bold;'><strong style="color:white;">Nombre: </strong> {{ $nombre }}</p>
                    @endif
                    @if($apellido)
                        <p style='text-align:center;font-weight:bold;'><strong style="color:white;">Apellido: </strong> {{ $apellido }}</p>
                    @endif
            @endif
            
        <div class="tabla-cotainer">
            <table class="tabla">
                <thead>
                    <tr>
                        <th colspan="3" class="cabeza-tabla">Resultados de busqueda</th>
                    </tr>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre y Apellido</th>
                        <th>Historial</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td>{{ $paciente->DNI }}</td>
                            <td>{{$paciente->nombre}} {{ $paciente->apellido }}</td>
                             <td style="height:1cm;">
                                @php
                                    error_reporting(0);
                                @endphp
                                
                                <a href="{{ route('verHistorial', $paciente->id) }}" style="text-decoration:none;padding:5px;text-align:center;color:white;background:green;border-radius:10px;margin:5px;"><i class='far fa-eye'></i></a>
                                <a href="{{ route('agregarHistorial', $paciente->id) }}" style="text-decoration:none;padding:5px;text-align:center;color:white;background:purple;border-radius:10px;margin:5px;"><i class='fas fa-plus'></i></a>
                            </td>
                        </tr>       
                    @endforeach

                </tbody>
            </table>
        </div> 
    </section>
@endsection