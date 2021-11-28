<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function confirm(Request $request){
        
        $request->validate([
            'usuario'=>'required',
            'clave'=>'required'
        ]);
        
        echo "here i am";
    }
}
