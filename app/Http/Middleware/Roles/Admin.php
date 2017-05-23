<?php

namespace App\Http\Middleware\Roles;

use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
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
        if (Auth::check() && Auth::user()->hasRole(config('constants.role.ADMINISTRATOR'))) {
            return $next($request);
        }
        return authorize(Auth::user());
    }
}
