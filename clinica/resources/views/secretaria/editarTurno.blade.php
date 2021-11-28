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
    @if($error)
        <script>
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Probablemente olvidaste llenar algunos campos!'
            })
        </script>
    @endif
    <section>
        <a href="{{ route('listaTurnos.show') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Editar turno</h1>
        <div class="form-container">
            <form action="/inicio/listaTurnos/editar/consultar-horarios-edicion" method="POST" id='form1'>
                @csrf
                @method('POST')
                <li>
                    <label for="">Doctor: </label>
                    <select name="doctor">
                        <option value="{{$turno[0]->usuario_doctor_id}}" selected>{{$turno[0]->nombre}} {{$turno[0]->apellido}}</option>
                        @foreach ($doctores as $doctor)
                            @if($doctor->id != $turno[0]->usuario_doctor_id)
                                <option value="{{$doctor->id}}"> {{$doctor->nombre}} {{$doctor->apellido}}</option>
                            @endif
                        @endforeach
                    </select>
                        @if($turno[0]->id)
                            <input name='turno' type='number' min='1' style="display:none;" value="{{ $turno[0]->id }}">
                            @else
                            <input name='turno' type='number' min='1' style="display:none;" value="{{ $turno }}">

                        @endif
                    @error('doctor')
                        <small style="color:red">*{{$message}}</small>
                    @enderror
                </li>
                <li><label for="">Fecha: </label><input type="date" name="fecha" value="{{ old('fecha',$turno[0]->fecha) }}"></li>
                @error('fecha')
                    <small style="color:red">*{{$message}}</small>
                @enderror
                <button type="submit" name="btn-fecha" class="btn btn-success boton-guardar">Consultar horarios</button>
            </form>



        </div>
        @php
            // No mostrar los errores de PHP
            error_reporting(0);    
            $fechaFormato=date("d/m/Y", strtotime($fecha));
        @endphp
            <form action='{{route('guardarEdicionTurno')}}' method='POST' id="form2" style="visibility:hidden">
                <p class='titulo-medio'> Horarios disponibles</p>
                <div id="informacionTurno">
                </div>
                @csrf
                @method('put')
                <li>
                    <label>Hora: </label>
                    <select name='hora' id="select-hora">
                        <option value="">-</option>
                    </select>
                    <div id="inputsOcultos">
                    </div>
                </li>
                <button type='submit' name='btn-reservar' class='btn btn-success boton-guardar'>Guardar</button>
            </form>
        
    </section>
    <script>
        $(document).ready(function(){
            $('#form1').submit(function(event){
                event.preventDefault();
                $('#form2').css({'visibility':'visible'});
                $.ajax({
                    url:'/inicio/listaTurnos/editar/consultar-horarios-edicion',
                    method:'POST',
                    data:$('#form1').serialize()
                }).done(function(respuesta){
                    var respuesta = JSON.parse(respuesta);
                    var horarios =respuesta[0];
                    var mostrarHorarios='<option value="" selected>-</option>';
                    for(var i=0;i<horarios.length;i++){
                        if(horarios[i] != null){
                            mostrarHorarios+='<option value='+horarios[i]+'>'+horarios[i]+':00</option>';
                        }
                    }
                    $('#select-hora').empty();
                    $('#select-hora').append(mostrarHorarios);
    
                    var info1='<p>Con: '+ respuesta[4].nombre +' '+ respuesta[4].apellido +'</p>';
                    var info2='<p>Fecha: '+ respuesta[1] +'</p>';
                    $('#informacionTurno').empty();
                    $('#informacionTurno').append([info1,info2]);
    
                    var fecha='<input type="date" name="fechaa" value="'+respuesta[1]+'" style="display:none">';
                    var doctor_id='<input name="doctorr" value="'+respuesta[2]+'" style="display:none">';
                    var turno='<input name="turno" type="number" min="1" style="display:none" value="'+respuesta[3]+'">';
                    $('#inputsOcultos').empty();
                    $('#inputsOcultos').append([fecha,turno,doctor_id]);
                });
            })
        })


    </script>
@endsection