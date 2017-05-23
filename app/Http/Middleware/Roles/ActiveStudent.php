<?php

namespace App\Http\Middleware\Roles;

use Illuminate\Support\Facades\Auth;
use Closure;

class ActiveStudent
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
        if (Auth::user()->hasRole(config('constants.role.STUDENT_WORKER')) && Auth::user()->hasStatus(config('constants.user_status.ACTIVE'))) {
            return $next($request);
        }
        return authorize(Auth::user());
    }
}
