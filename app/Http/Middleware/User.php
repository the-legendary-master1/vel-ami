<?php

namespace App\Http\Middleware;

use Closure;

class User
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role == "User"){
            return $next($request);
        }
        return redirect('/');
    }
}
