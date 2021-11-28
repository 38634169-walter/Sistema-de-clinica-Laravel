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
    @if($modificado)
        <script>
            Swal.fire(
              'Modificado!',
              'Se modifico con exito!',
              'success'
            )
        </script>
    @endif
    <section>
        <a href="{{ route('listaTurnos.show') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Turno</h1>
        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th colspan="2" class="cabeza-tabla">Paciente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><strong>Nombre: </strong></td><td>{{$datos[0]->nombre}}</td></tr>
                    <tr><td><strong>Apellido: </strong></td><td>{{$datos[0]->apellido}}</td></tr>
                    <tr><td><strong>DNI: </strong></td><td>{{$datos[0]->DNI}}</td></tr>
                    <tr><td><strong>Fecha: </strong></td><td>{{$datos[0]->fecha}}</td></tr>
                    <tr><td><strong>Hora: </strong></td><td>{{$datos[0]->hora}}:00Hs</td></tr>
                    <tr><td><strong>Doctor/a: </strong></td><td>{{$datos[0]->nombreDoctor}} {{$datos[0]->apellidoDoctor}}</td></tr>
                    </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style='height:1cm;display:flex;justify-content:center;align-items:center;margin:0;width:153%;'>
                            <a href="{{ route('listaTurnos.edit',$datos[0]->id) }}" style='text-decoration:none;padding:5px;text-align:center;color:white;background:rgb(143, 135, 29);border-radius:10px;margin:3px;'><i class='fas fa-edit'></i> Editar</a>
                            <form action="{{ route('listaTurnos.delete',$datos[0]->id) }}" style="margin:3px;" class="eliminar"  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style='text-decoration:none;padding:5px;text-align:center;color:white;background:red;border-radius:10px;border:none;'><i class='fas fa-trash-alt'></i>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <script >
            $('.eliminar').submit(function(e){
                e.preventDefault();

                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podras deshacer los cambios!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '',
                    confirmButtonText: 'Si, eliminar!',
                    reverseButtons:true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        </script>
    </section>
@endsection