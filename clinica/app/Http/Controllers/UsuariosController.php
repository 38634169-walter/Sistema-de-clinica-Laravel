<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\Cargos;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    //

    public function confirm(Request $request){
        $request->validate([
            'usuario'=>'required',
            'clave'=>'required'
        ]);
        $validar=new Usuarios;
        $validar=Usuarios::where('usuario',$request->usuario)->first();
        if($validar){
            if($validar->usuario == $request->usuario && $validar->clave ==$request->clave){
                session(['logged'=>true]);
                session(['nombreUsu'=>$validar->nombre]);
                session(['idUsu'=>$validar->id]);
                session(['rolUsu'=>$validar->cargo_id]);
                $cargo=new Cargos;
                $cargo=Cargos::where('id',$validar->cargo_id)->first();
                session(['cargoUsu'=>$cargo->tipoCargo]);
                return redirect()->route('inicio');
            }
        }
        return back()->withErrors(['error'=>'error']);
    }

    public function destroy(){
        session()->flush();
        return redirect()->to('/login');
    }

    public function doctores(){
        $doctores=new Usuarios;
        $doctores=Usuarios::where('cargo_id',3)->get();
        return view('secretaria/asignarPaciente',compact('doctores'));
    }
    
}
