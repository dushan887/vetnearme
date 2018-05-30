<?php

namespace App\Http\Middleware;

use Closure;

class TemporaryPassword
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
        if ($request->user()->temporary_password)
            return redirect()->route('changePassword')->with('message', 'Before using the panel you will have to update your password!');

        return $next($request);
    }
}
