<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class AdminMiddleware
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

        if (Auth::check() && $role == 3) {
            return $next($request);
        }
    }
}
