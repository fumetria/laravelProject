<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Auth::check() en Laravel se usa para verificar si un usuario está autenticado (o sea, si ya inició sesión).
        if (Auth::check() && !Auth::user()->is_active) {
            Auth()->guard('web')->logout();
            return redirect('/login')->with(['error' => 'cuenta desactivada']);
        }
        return $next($request);
    }
}
