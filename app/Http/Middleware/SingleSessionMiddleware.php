<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SingleSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $currentSessionId = Auth::user()->session_id;
            if ($currentSessionId != Session::getId()) {
                Auth::logout();
                return redirect('/login')->withErrors(['Your account is logged in from another device.']);
            }
        }

        // return $next($request);
        return $next($request);
    }
}
