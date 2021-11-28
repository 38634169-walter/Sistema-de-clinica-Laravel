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
    @if($guardado)
        <script>
            Swal.fire(
              'Guardado!',
              'Se guardo con exito!',
              'success'
            )
        </script>
    @endif
    <section>
        <a href="{{ route('inicio') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Asignar paciente</h1>
        <div class="form-container">
            <form action="/inicio/asignar-paciente/consultar-horarios" method="POST" id="form1">
                @csrf
                <li>
                    <label for="">Doctor: </label>
                    <select name="doctor" id="">
                        <option value="" selected>-</option>
                        @foreach ($doctores as $doctor)
                            <option value="{{$doctor->id}}"> {{$doctor->nombre}} {{$doctor->apellido}}</option>
                        @endforeach
                    </select>
                    @error('doctor')
                        <small style="color:red">*{{$message}}</small>
                    @enderror
                </li>
                <li><label for="">Fecha: </label><input type="date" name="fecha" value="{{ old('fecha') }}"></li>
                @error('fecha')
                    <small style="color:red">*{{$message}}</small>
                @enderror
                <button type="submit" name="btn-fecha" class="btn btn-success boton-guardar">Consultar horarios</button>
            </form>
        </div>
        @php
               
        @endphp
            <form id="form2" action='{{ route('turnos.store') }}' method='POST' style="visibility:hidden;">
                <p class='titulo-medio'> Horarios disponibles</p>
                <div id="turnoInfo">   
                </div>
                @csrf
                <li>
                    <label>Hora: </label>
                    <select name='hora' id="horarios">
                    </select>
                    @error('hora')
                        <small style="color:red">*{{$message}}</small>
                    @enderror
                </li>
                <li><label>DNI(paciente): </label><input name='dni' type='number' min='1' value={{ old('dni') }}></li>
                @error('dni')
                    <small style="color:red">*{{$message}}</small>
                @enderror
                <div id="inputsOcultos">
        
                </div>
                <button type='submit' name='btn-reservar' class='btn btn-success boton-guardar'>Guardar</button>
            </form>
    </section>
    <script>
        $(document).ready(function(){
            $('#form1').submit(function(event){
                event.preventDefault();
                $('#form2').css({'visibility':'visible'});
                $.ajax({
                    url:'/inicio/asignar-paciente/consultar-horarios',
                    method:'POST',
                    data:$('#form1').serialize()
                }).done(function(respuesta){
                    var respuesta = JSON.parse(respuesta);
                    var horarios=respuesta[0];
                    var fecha=respuesta[1];
                    var doctor=respuesta[2];
                    var doctorr=respuesta[3];
                    var mostrarHorarios='<option value="" selected>-</option>';
                    for(var i=0;i<horarios.length;i++){
                        if(horarios[i] != null){
                            mostrarHorarios+='<option value="'+ horarios[i] +'">'+ horarios[i] +':00</option>';
                        }
                    }
                    $('#horarios').empty();
                    $('#horarios').append(mostrarHorarios);
                
                    var infoDoctor='<p>Con: '+ doctorr.nombre +' '+ doctorr.apellido +' </p>';
                    var infoFecha='<p>Para: '+ fecha +'</p>';
                    $('#turnoInfo').empty();
                    $('#turnoInfo').append([infoDoctor,infoFecha]);
                    
                    var inputFecha='<input name="fechaa" value="'+ fecha +'" style="display:none">';
                    var inputDoctor='<input name="doctorr" value="'+ doctor +'" style="display:none">';
                    $('#inputsOcultos').empty();
                    $('#inputsOcultos').append([inputFecha,inputDoctor]);
                });
            })
        })
    </script>
@endsection