<?php

namespace App\Http\Middleware;

use Closure;

class TypeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->id_tipo_usuario == 1) {
            return $next($request);
        } else {
            return redirect('/');
            
        }
        

        
    }
}
