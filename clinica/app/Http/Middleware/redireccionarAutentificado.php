<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class redireccionarAutentificado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        if(session('logged')==true){
            return redirect()->to('/inicio');
        }
        else{
            return $next($request);
        }
    }
}
