@extends('layout')

@section('cdns')
    <link rel="stylesheet" href="{{ asset('css/asignarPac.css') }}">
    <!--SWEET-ALERT-2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    @php
        // No mostrar los errores de PHP
        error_reporting(0);    
    @endphp
    @if($noRegistrado)
        <script>
            Swal.fire({
              icon: 'error',
              title: 'Paciente no registrado',
              text: 'Presiona OK para registrarlo!'
            })
        </script>
    @endif


    @php
        // No mostrar los errores de PHP
        error_reporting(0);    
    @endphp
    @if($usuarioRegistrado)
        <script>
            Swal.fire({
              icon: 'error',
              title: 'Paciente registrado',
              text: 'El paciente ya se encuentra registrado!'
            })
        </script>
    @endif

    @if($guardado)
        <script>
            Swal.fire({
              icon: 'success',
              title: 'Guardado',
              text: 'Se registro con exito!'
            })
        </script>
    @endif


    <section>
        <a href="{{ route('inicio') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Registar paciente</h1>
        <div class="form-container">
            <form action="{{ route('registrarPaciente.store') }}" method="POST">
                @csrf
                <li><label>Nombre: </label><input name='nombre' type='text' value="{{ old('nombre') }}"></li>
                @error('nombre')
                    <small style="color:red">*{{ $message }}</small>
                @enderror
                <li><label>Apellido: </label><input name='apellido' type='text' value="{{ old('apellido') }}"></li>
                @error('apellido')
                    <small style="color:red">*{{ $message }}</small>
                @enderror
                <li><label>DNI: </label><input name='dni' type='number' min="1" value="{{ old('dni') }}"></li>
                @error('dni')
                    <small style="color:red">*{{ $message }}</small>
                @enderror
                <li><label>Telefono: </label><input name='telefono' type='number' min="1" value="{{ old('telefono') }}"></li>
                @error('telefono')
                    <small style="color:red">*{{ $message }}</small>
                @enderror
                <li><label>Email: </label><input name='email' type='email' value="{{ old('email') }}"></li>
                @error('email')
                    <small style="color:red">*{{ $message }}</small>
                @enderror
                <li><label>Fecha de nacimiento: </label><input name='fechaNacimiento' type='date' value="{{ old('fechaNacimiento') }}"></li>
                @error('fechaNacimiento')
                    <small style="color:red">*{{ $message }}</small>
                @enderror
                <button type="submit" name='btn-registrar-paciente' class='btn btn-success boton-guardar'>Guardar</button>
            </form>
        </div>
    </section>
@endsection