@extends('layout')

@section('cdns')
    <link rel="stylesheet" href="{{ asset('css/asignarPac.css') }}">
    <!--SWEET-ALERT-2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    @php
        error_reporting(0);
    @endphp
    @if($eliminado)
        <script>
            Swal.fire(
              'Eliminado!',
              'Se elimino con exito!',
              'success'
            )
        </script>
    @endif
    <a href="{{ route('inicio') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Lista de turnos</h1>
    <br>
    <h3 class="titulo-medio">Buscar turno por:</h3>
    <form class="form-split" action="{{ route('listaTurnos.show2')}}" method="POST">
        @csrf
        <div class="form-split">
            <li><label>DNI de paciente: </label><input type="number" name="dni" min="1" value="{{ old('dni') }}"></li>    
            <li><label>Fecha: </label><input type="date" name="fecha" value="{{ old('fecha') }}"></li>        
            <button type="submit" class="btn btn-success boton-guardar">Buscar</button>
        </div>
        @error('dni')
            <small style="color:red">*Se debe ingresar al menos un dato para la busqueda</small>
        @enderror
        @error('fecha')
            <small style="color:red">*Se debe ingresar al menos un dato para la busqueda</small>
        @enderror

    </form>


    <h3 class="titulo-medio">Turnos:</h3>
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
            
            @if($noHayTurnos)
                <tr>
                    <td colspan="3">
                        <li><p>No hay turnos</p></li>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div> 

@endsection