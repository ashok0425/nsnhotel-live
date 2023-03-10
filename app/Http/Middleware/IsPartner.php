<?php

namespace App\Http\Middleware;

use Closure;

class IsPartner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  
        if (auth()->user()->isPartner() && auth()->user()->isActive()) {
            return $next($request);
        }
        return abort(401);
    }
}
