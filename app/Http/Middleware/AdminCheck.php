<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        // Check if the user is logged in
        if (Auth::check()) {
            // If the user is 'admin@gmail.com', allow access
            if (Auth::user()->email === 'admin@ictau.com') {
                return $next($request);  // Proceed to the next middleware or controller
            } else {
                // If the user is logged in but not 'admin@gmail.com'
                return redirect('/apply');
            }
        } else {
            // If the user is not logged in, redirect to the login page
            return redirect('/login');
        }
    }
}
