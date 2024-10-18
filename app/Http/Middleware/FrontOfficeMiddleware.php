<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontOfficeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'front-office' role
        if (Auth::check() && Auth::user()->user_type === 'front-office') {
            return $next($request);
        }

        // Redirect to the login page or any other page if unauthorized
        return redirect()->route('login'); // Change this to the appropriate route
    }
}
