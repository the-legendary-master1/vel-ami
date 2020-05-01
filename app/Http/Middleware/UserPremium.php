<?php

namespace App\Http\Middleware;

use Closure;

class UserPremium
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role == "User-Premium"){
            return $next($request);
        }
        return redirect('/');
    }
}
