<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if((auth()->user()->role=='administrador')||(auth()->user()->role=='Administrador Evaluacion')||('Administrador Secretaria'))
            {
                return redirect()->route('admin');
            }
            else if(auth()->user()->role=='Professor'){
                return redirect()->route('professor.mainIndex');
            }
            else{
                return redirect()->route('student.mainIndex');
            }
        }

        return $next($request);
    }
}
