<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes;
use App\Models\Historiales;

class PacientesController extends Controller
{
    //

    public function store(Request $request){
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'dni'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'fechaNacimiento'=>'required'
        ]);
        $paciente1=new Pacientes;
        $paciente1=Pacientes::select('DNI')->where('DNI',$request->dni)->first();
        if(empty($paciente1['DNI'])){
            $paciente=new Pacientes;
            $paciente->nombre=$request->nombre;
            $paciente->apellido=$request->apellido;
            $paciente->DNI=$request->dni;
            $paciente->telefono=$request->telefono;
            $paciente->email=$request->email;
            $paciente->fechaNacimiento=$request->fechaNacimiento;
            $paciente->save();
            $guardado=true;
            return view('secretaria/registrarPaciente',compact('guardado'));
        }
        else{
            $usuarioRegistrado=true;
            return view('secretaria/registrarPaciente',compact('usuarioRegistrado'));
        }
    }

    public function show(){
        $pacientes=new Pacientes;
        $pacientes=Pacientes::orderBy('nombre','asc')->get();
        return view('doctor/verPaciente',compact('pacientes'));
    }

    public function buscar_paciente(Request $request){
        
        if(empty($request->dni) && empty($request->nombre)){
            $request->validate([
                'apellido'=>'required'
            ]);
        }
        if(empty($request->dni) && empty($request->apellido)){
            $request->validate([
                'nombre'=>'required'
            ]);
        }
        if(empty($request->apellido) && empty($request->nombre)){
            $request->validate([
                'dni'=>'required'
            ]);
        }


        //consultas
        $pacientes=new Pacientes;
        if($request->dni){
            $pacientes=Pacientes::where('DNI',$request->dni)
            ->orderBy('nombre','asc')
            ->get();
        }
        else{
            if($request->apellido && $request->nombre){
                $pacientes=Pacientes::where('nombre','like',"%$request->nombre%")
                        ->where('apellido','like',"%$request->apellido%")
                        ->orderBy('nombre','asc')
                        ->get();
            }
            else{
                if($request->apellido){
                    $pacientes=Pacientes::where('apellido','like',"%$request->apellido%")
                        ->orderBy('nombre','asc')
                        ->get();
                }
                if($request->nombre){
                    $pacientes=Pacientes::where('nombre','like',"%$request->nombre%")
                        ->orderBy('nombre','asc')
                        ->get();
                }
            }
        }
        $dni=$request->dni;
        $nombre=$request->nombre;
        $apellido=$request->apellido;
        return view('doctor/busquedaPaciente',compact('pacientes','dni','nombre','apellido'));
    }

    public function ver_historial($id){
        $historiales=new Historiales;
        $historiales=Historiales::join('usuarios','usuarios.id','historiales.doctor_id')
            ->where('paciente_id',$id)
            ->orderBy('fecha','desc')
            ->get();
        return view('doctor/verHistorial',compact('historiales'));
    }
    
    public function agregar_historial($id){
        return view('doctor/agregarHistorial',compact('id'));
    }

    public function guardar_historial(Request $request,$id){
        $request->validate([
            'fecha'=>'required',
            'observacion'=>'required'
        ]);
        
        $historial=new Historiales;
        $historial->paciente_id = $id;
        $historial->doctor_id = session('idUsu');
        $historial->fecha = $request->fecha;
        $historial->diagnostico = $request->observacion;
        

        if($historial->save()){
            $guardado='si';
            $pacientes=new Pacientes;
            $pacientes=Pacientes::orderBy('nombre','asc')->get();
            return view('doctor/verPaciente',compact('guardado','pacientes'));
        }
        else{
            $guardado='no';
            $pacientes=new Pacientes;
            $pacientes=Pacientes::orderBy('nombre','asc')->get();
            return view('doctor/verPaciente',compact('guardado','pacientes'));
        }
    }
}
