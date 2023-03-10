<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if($request->route()->getPrefix() === "/partnercp") {
                return route('partner_login');
            } elseif ($request->route()->getPrefix() === "/admincp") {
                return route('admin_login');
            }
            route('home');
        }
    }
}
