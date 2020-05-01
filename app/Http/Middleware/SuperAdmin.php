<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdmin
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role == "Super-Admin"){
            return $next($request);
        }
        return redirect('/');
    }
}
