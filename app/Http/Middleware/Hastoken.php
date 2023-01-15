<?php

namespace App\Http\Middleware;

use Closure;

class Hastoken
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
      if(isset($request->header()['authorization'][0])&&$request->header()['authorization'][0]!=null){
        return $next($request);
      }else{
        return response()->json([
           'message'=> 'unauthorized',
           'data'=> '',
        ],403);
      }
    }
}
