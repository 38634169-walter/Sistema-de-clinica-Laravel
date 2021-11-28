@extends('layout')

@section('cdns')
    <link rel="stylesheet" href="{{ asset('css/asignarPac.css') }}">
@endsection

@section('content')
    <section>
        <a href="{{ route('verMisTurnos') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Turno</h1>
        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th colspan="3" class="cabeza-tabla">Paciente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><strong>Nombre: </strong></td><td>{{ $turno[0]->nombre }}</td></tr>
                    <tr><td><strong>Apellido: </strong></td><td>{{ $turno[0]->apellido }}</td></tr>
                    <tr><td><strong>DNI: </strong></td><td>{{ $turno[0]->DNI }}</td></tr>
                    <tr><td><strong>Fecha: </strong></td><td>{{ $turno[0]->fecha }}</td></tr>
                    <tr><td><strong>Hora: </strong></td><td>{{ $turno[0]->hora }}:00</td></tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection