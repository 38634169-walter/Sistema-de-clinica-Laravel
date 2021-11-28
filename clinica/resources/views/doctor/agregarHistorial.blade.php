@extends('layout')

@section('cdns')
    <link rel="stylesheet" href="{{ asset('css/asignarPac.css') }}">
@endsection

@section('content')
    <section>
        <a href="{{ route('verPacientes') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Agregar historia</h1>
        <div class="form-container">
            <form action="{{ route('guardarHistorial',$id) }}" method="POST">
                @csrf
                <li><label>Fecha: </label><input name='fecha' type='date'placeholder="Fecha" value="{{ old('fecha') }}"></li>
                @error('fecha')
                    <small style="color:red;">*{{ $message }}</small>
                @enderror
                <li><label>Observacion: </label><textarea name="observacion" cols="30" rows="10" placeholder="Observacion" value="{{ old('diagnostico') }}"></textarea>
                @error('observacion')
                    <small style="color:red;">*{{ $message }}</small>
                @enderror
                <button type="submit" name='btn-agregar-historial' class='btn btn-success boton-guardar'>Guardar</button>
            </form>
        </div>
    </section>
@endsection