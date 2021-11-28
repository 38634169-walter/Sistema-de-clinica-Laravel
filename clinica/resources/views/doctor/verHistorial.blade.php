@extends('layout')

@section('cdns')
    <link rel="stylesheet" href="{{ asset('css/asignarPac.css') }}">
@endsection

@section('content')
    <section>
        <a href="{{ route('verPacientes') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Historial</h1>
        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th colspan="3" class="cabeza-tabla">Historial</th>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <th>Observacion</th>
                        <th>Doctor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $historiales as $historial)
                        <tr>
                            <td>{{ $historial->fecha }}</td>
                            <td>{{ $historial->diagnostico}}</td>
                            <td>{{ $historial->nombre }} {{ $historial->apellido }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
    </section>
@endsection 