<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutenticacionDoctor
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
            if(session('rolUsu')== 3){
                return $next($request);        
            }
            else{
                return redirect()->route('inicio');
            }
        }
        else{
            return redirect()->route('index');
        }
    }
}
