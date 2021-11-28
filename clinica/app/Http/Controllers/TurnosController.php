<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turnos;
use App\Models\Usuarios;
use App\Models\Pacientes;

class TurnosController extends Controller
{
    //
    public function consultar_horarios(Request $request){
        $request->validate([
            'doctor'=>'required',
            'fecha'=>'required'
        ]);
        $turnos=new Turnos;
        $turnos=Turnos::select('hora')->where('fecha',$request->fecha)->where('usuario_doctor_id',$request->doctor)->get();
        $horarios=array(8,9,10,11,12,13,14,15,16,17,18,19,20);
        $tam1=sizeof($horarios);
        $tam2=sizeof($turnos);
        for($i=0;$i<$tam1;$i++){
            for($j=0;$j<$tam2;$j++){
                // No mostrar los errores de PHP
                error_reporting(0);
                if($horarios[$i] == $turnos[$j]->hora){
                    for($x=$i;$x<$tam1;$x++){
                        $horarios[$x]=$horarios[$x+1];
                    }
                }
            }
        }

        $doctorr=new Usuarios;
        $doctorr=Usuarios::where('id',$request->doctor)->first();
        $fecha=$request->fecha;
        $doctor=$request->doctor;
        //return response(json_encode([$horarios,$fecha,$doctor,$turno,$doctorr]),200)->header('Content-type','text-plain');
        return response(json_encode([$horarios,$fecha,$doctor,$doctorr]),200)->header('Content-type','text-plain');
        //return view('secretaria/asignarPaciente',compact(['horarios','doctores','fecha','doctorr']));
    }

    public function store(Request $request){
        if($request->hora == ""|| $request->dni == ""){
            $error='error';
            $doctores=new Usuarios;
            $doctores=Usuarios::where('cargo_id',3)->get();
            return view('secretaria/asignarPaciente',compact('error','doctores'));
        }
        $paciente=new Pacientes;
        $paciente=Pacientes::select('id')->where('DNI',$request->dni)->first();


        if(empty($paciente['id'])){
            $noRegistrado=true;
            return view('secretaria/registrarPaciente',compact('noRegistrado'));
        }
        else{
            $turno=new Turnos;
            $turno->fecha = $request->fechaa;
            $turno->hora = $request->hora;
            $turno->paciente_id = $paciente['id'];
            $turno->usuario_doctor_id = $request->doctorr;
            $turno->usuario_secretaria_id = session('idUsu');
            $turno->save();
            
            $doctores=new Usuarios;
            $doctores=Usuarios::where('cargo_id',3)->get();
            $guardado=true;
            return view('secretaria/asignarPaciente',compact('guardado','doctores'));
        }
            
    }

    public function show($eliminado=false){
        $turnos=new Turnos;
        $turnos=Turnos::all();
        if(empty($turnos[0])){
            $noHayTurnos=true;
            if($eliminado){
                return view('secretaria/listaTurnos',compact('noHayTurnos,eliminado'));
            }
            return view('secretaria/listaTurnos',compact('noHayTurnos'));
        }

        $datos= Pacientes::join('turnos','turnos.paciente_id','=','pacientes.id')
            ->orderBy('turnos.fecha','desc')
            ->get(['turnos.id','turnos.fecha','pacientes.nombre','pacientes.apellido']);
        if($eliminado){
            return view('secretaria/listaTurnos',compact('datos','eliminado'));
        }
        return view('secretaria/listaTurnos',compact('datos'));

    }

    public function show2(Request $request){
        if($request->dni == ""){
            $request->validate([
                'fecha'=>'required'
            ]);
            $datos=Pacientes::join('turnos','turnos.paciente_id','=','pacientes.id')
                ->where('fecha',$request->fecha)
                ->get(['turnos.id','turnos.fecha','pacientes.nombre','pacientes.apellido']);
            $fecha=$request->fecha;
            return view('secretaria/buscarTurno',compact('datos','fecha'));
        }
        $paciente_id=new Pacientes;
        $paciente_id=Pacientes::select('id')->where('DNI',$request->dni)->first();
        if($request->fecha == ""){
            $request->validate([
                'dni'=>'required'
            ]);
            $datos=Pacientes::join('turnos','turnos.paciente_id','=','pacientes.id')
                ->where('turnos.paciente_id',$paciente_id['id'])
                ->get(['turnos.id','turnos.fecha','pacientes.nombre','pacientes.apellido']);
            $dni=$request->dni;
            return view('secretaria/buscarTurno',compact('datos','dni'));
        }
        $datos=Pacientes::join('turnos','turnos.paciente_id','=','pacientes.id')
            ->where('turnos.fecha',$request->fecha)
            ->where('pacientes.id',$paciente_id['id'])
            ->get(['turnos.id','turnos.fecha','pacientes.nombre','pacientes.apellido']);
        $dni=$request->dni;
        $fecha=$request->fecha;
        return view('secretaria/buscarTurno',compact('datos','fecha','dni'));
    }

    public function turnoInfo(Turnos $turno,$modificado=""){
        $datos=Turnos::join('pacientes','pacientes.id','=','turnos.paciente_id')
            ->join('usuarios','usuarios.id','=','turnos.usuario_doctor_id')
            ->where('turnos.id',$turno['id'])
            ->get(['turnos.id','turnos.fecha','turnos.hora','usuarios.nombre as nombreDoctor','usuarios.apellido as apellidoDoctor','pacientes.nombre','pacientes.apellido','pacientes.DNI']);
        if($modificado== ""){
            return view('secretaria/verTurno',compact('datos'));
        }
        return view('secretaria/verTurno',compact('datos','modificado'));

    }

    public function delete(Turnos $turno){
        $turnoEliminar=new Turnos;
        $turnoEliminar=Turnos::where('id',$turno->id);
        if($turnoEliminar->delete()){
            $eliminado=true;
            return $this->show($eliminado);
        }
    }

    public function edit(Turnos $turno,$error=""){
        $doctores=new Usuarios;
        $doctores=Usuarios::where('cargo_id','3')->get();
        
        $turno=Usuarios::join('turnos','turnos.usuario_doctor_id','=','usuarios.id')
            ->where('turnos.id',$turno->id)
            ->get();
        if($error==""){
            return view('secretaria/editarTurno',compact('turno','doctores'));
        }
        else{
            return view('secretaria/editarTurno',compact('turno','doctores','error'));
        }
    }

    public function consultarHorariosEdicion(Request $request){
        $request->validate([
            'doctor'=>'required',
            'fecha'=>'required'
        ]);
        $turnos=new Turnos;
        $turnos=Turnos::select('hora')->where('fecha',$request->fecha)->where('usuario_doctor_id',$request->doctor)->get();
        $horarios=array(8,9,10,11,12,13,14,15,16,17,18,19,20);
        $tam1=sizeof($horarios);
        $tam2=sizeof($turnos);
        for($i=0;$i<$tam1;$i++){
            for($j=0;$j<$tam2;$j++){
                // No mostrar los errores de PHP
                error_reporting(0);
                if($horarios[$i] == $turnos[$j]->hora){
                    for($x=$i;$x<$tam1;$x++){
                        $horarios[$x]=$horarios[$x+1];
                    }
                }
            }
        }

        $doctorr=new Usuarios;
        $doctorr=Usuarios::where('id',$request->doctor)->first();
        $fecha=$request->fecha;
        $doctor=$request->doctor;
        $turno=$request->turno;

        return response(json_encode([$horarios,$fecha,$doctor,$turno,$doctorr]),200)->header('Content-type','text-plain');
    }

    public function guardarEdicionTurno(Request $request){
        if($request->hora == ""){
            $turno=new Turnos;
            $turno->id=$request->turno;
            $error=true;
            return $this->edit($turno,$error);
        }
    
        $turno1=new Turnos;
        $turno1=Turnos::where('id',$request->turno)->first();
        $pacienteID=$turno1['paciente_id'];
        $turno1->delete();

        $turno=new Turnos;
        $turno->id=$request->turno;
        $turno->fecha = $request->fechaa;
        $turno->hora = $request->hora;
        $turno->paciente_id = $pacienteID;
        $turno->usuario_doctor_id = $request->doctorr;
        $turno->usuario_secretaria_id = session('idUsu');
        $turno->save();
        
        $modificado=true;
        return $this->turnoInfo($turno,$modificado);    
    }

    public function ver_mis_turnos(){
        $turnos=new Turnos;
        $turnos=Turnos::join('pacientes','pacientes.id','=','turnos.paciente_id')
        ->where('turnos.usuario_doctor_id',session('idUsu'))
        ->orderBy('turnos.fecha','desc')
        ->get(['turnos.id as turnosID', 'turnos.fecha','pacientes.nombre','pacientes.apellido']);
        if(empty($turnos[0])){
            $noHayTurnos=true;
            return view('doctor/verMisTurnos',compact('turnos','noHayTurnos'));    
        }
        return view('doctor/verMisTurnos',compact('turnos'));
    }

    public function buscar_turno_doctor(Request $request){
        if(empty($request->dni)){
            $request->validate([
                'fecha'=>'required'
            ]);
        }
        if(empty($request->fecha)){
            $request->validate([
                'dni'=>'required'
            ]);
        }
        
        $turno=new Turnos;
        if($request->fecha && $request->dni){
            $turnos=Turnos::join('pacientes','pacientes.id','=','turnos.paciente_id')
                ->where('turnos.fecha',$request->fecha)
                ->where('pacientes.DNI',$request->dni)
                ->orderBy('turnos.fecha','desc')
                ->get(['turnos.id as turnosID', 'turnos.fecha','pacientes.nombre','pacientes.apellido']);
        }
        else{
            if($request->fecha){
                $turnos=Turnos::join('pacientes','pacientes.id','=','turnos.paciente_id')
                    ->where('turnos.fecha',$request->fecha)
                    ->orderBy('turnos.fecha','desc')
                    ->get(['turnos.id as turnosID', 'turnos.fecha','pacientes.nombre','pacientes.apellido']);
            }
            if($request->dni){
                $turnos=Turnos::join('pacientes','pacientes.id','=','turnos.paciente_id')
                    ->where('pacientes.DNI',$request->dni)
                    ->orderBy('turnos.fecha','desc')
                    ->get(['turnos.id as turnosID', 'turnos.fecha','pacientes.nombre','pacientes.apellido']);
            }
        }
        $dni=$request->dni;
        $fecha=$request->fecha;
        if(empty($turnos[0])){
            $noHayTurnos=true;
            return view('doctor/buscarTurnoDoctor',compact('turnos','fecha','dni','noHayTurnos'));    
        }
        return view('doctor/buscarTurnoDoctor',compact('turnos','fecha','dni'));
    }

    public function ver_turno_doctor($id){
        $turno=new Turnos;
        $turno=Turnos::join('pacientes','pacientes.id','=','turnos.paciente_id')
            ->where('turnos.id',$id)
            ->get();
        return view('doctor/verTurnoDoctor',compact('turno'));
    }
}
