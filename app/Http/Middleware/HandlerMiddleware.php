<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class HandlerMiddleware
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

        if (Auth::check() && $role == 2) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
