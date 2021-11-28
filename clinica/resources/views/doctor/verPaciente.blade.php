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
    @if($guardado=='si')
        <script>
            Swal.fire(
              'Guardado!',
              'Se guardo con exito!',
              'success'
            )
        </script>
        @else
            @if($guardado=='no')
                <script>
                    Swal.fire({
                      icon: 'error',
                      title: 'Fallo',
                      text: 'Algo salio mal!'
                    })
                </script>
            @endif
    @endif
    
    <section>
        <a href="{{ route('inicio') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Pacientes</h1>
        <br>
        <h3 class="titulo-medio">Buscar paciente por:</h3>
        <form class="form-split" action="{{ route('buscarPaciente') }}" method="POST">
            @csrf
            <div class="form-split">
                <li><label>DNI: </label><input type="number" min="1" name="dni" placeholder="DNI" value="{{ old('dni') }}"></li>    
                <li><label>Nombre: </label><input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}"></li>        
                <li><label>Apellido: </label><input type="text" name="apellido" placeholder="Apellido" value="{{ old('apellido') }}"></li>        
                <button type="submit" class="btn btn-success boton-guardar">Buscar</button>
            </div>
            @error('dni')
                <small style="color:red">*Al menos uno de los campos es requerido</small>
            @enderror
            @error('nombre')
                <small style="color:red">*Al menos uno de los campos es requerido</small>
            @enderror
            @error('apellido')
                <small style="color:red">*Al menos uno de los campos es requerido</small>
            @enderror
        </form>

        <h3 class="titulo-medio">Pacientes:</h3>
        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th colspan="3" class="cabeza-tabla">Pacientes</th>
                    </tr>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre y Apellido</th>
                        <th>Historial</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach( $pacientes as $paciente )
                        <tr>
                            <td> {{ $paciente->DNI }} </td>
                            <td> {{ $paciente->nombre }} {{ $paciente->apellido }}</td>
                            <td style="height:1cm;">
                                <a href="{{ route('verHistorial',$paciente->id) }}" style="text-decoration:none;padding:5px;text-align:center;color:white;background:green;border-radius:10px;margin:5px;"><i class='far fa-eye'></i></a>
                                <a href="{{ route('agregarHistorial',$paciente->id) }}" style="text-decoration:none;padding:5px;text-align:center;color:white;background:purple;border-radius:10px;margin:5px;"><i class='fas fa-plus'></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div> 
    </section>
@endsection