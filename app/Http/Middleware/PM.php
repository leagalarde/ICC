<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PM
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
        if(Auth::user()->el_position != 'Project Manager'){
            return redirect('/indexAdmin');
        }
        return $next($request);
    }
}
