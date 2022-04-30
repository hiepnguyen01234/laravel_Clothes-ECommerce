<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // Check user's role,
        // if has not admin role, then redirect home page
        if (Auth::check() && Auth::user()->name != "1")
        {
            return redirect('/home');
        }

        // If user has not logged in,
        // redirect to home page.
        // --★ Note ★--
        // Because the route '/home' had been checked automatically by phpAth,
        // so when redirect to this, it will be requested login.
        if (!Auth::check())
        {
            return redirect('/home');
        }

        return $next($request);
    }
}
