
    <a href="{{ route('listaTurnos.show') }}" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Resultados para: </h1>
        <?php
            if($_POST['dni']){
                echo "<p style='text-align:center;font-weight:bold;'> DNI: ".$_POST['dni']."</p>"; 
            }
            if($_POST['fecha']){
                echo "<p style='text-align:center;font-weight:bold;'> Fecha: ".$_POST['fecha']."</p>"; 
            }
        ?>





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
            @php
                error_reporting(0);
            @endphp
            @foreach ($datos as $dato)
                <tr>
                    <td>{{$dato->fecha}}</td>
                    <td>{{$dato->nombre}} {{$dato->apellido}}</td>
                    <td>
                        <li><a href="#"style='text-decoration:none;padding:5px;text-align:center;color:white;background:green;border-radius:10px;'><i class='far fa-eye'></i></a></li>
                    </td>
                </tr>
            @endforeach
            
            @if($noHayTurnos)
                <tr>
                    <td colspan="3">
                        <li><p>No hay resultados para la busqueda</p></li>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>