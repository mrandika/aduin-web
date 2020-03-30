<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class PeopleMiddleware
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
        // Check role
        $role = Auth::user()->role;

        if (Auth::check() && $role == 1) {
            return $next($request);
        }
    }
}
