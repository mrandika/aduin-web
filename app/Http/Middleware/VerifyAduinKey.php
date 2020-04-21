<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAduinKey
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
        if (env('ADUIN_CRYPT_TOOGLE') == false) {
            return $next($request);
        }

        $hasher = app('hash');
        $public_key = env('ADUIN_PUBLIC_KEY');
        $private_key = env('ADUIN_PRIVATE_KEY');

        if (!$public_key || !$private_key) {
            return abort(403, 'Unable to find requested key from this copy of Aduin.');
        }

        if ($hasher->check($public_key, $private_key)) {
            return $next($request);
        } else {
            return abort(403, 'Unable to verify this copy of Aduin.');
        }
    }
}
