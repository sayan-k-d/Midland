<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Check if the user is logged in and has the 'admin' role
        // if (Auth::check() && !in_array(Auth::user()->role_id, [1, 2])) {
        //     return redirect("/login")->withErrors(['Access denied. Admins only.']);
        // }
        if (Auth::check()) {
            // If role_id is not 1 (Admin), deny access to the /register route
            if (Auth::user()->role_id !== '1') {
                // If the user tries to access /register, redirect them
                if ($request->is('register')) {
                    return redirect("/dashboard")->withErrors(['Access denied. Admins only.']);
                }
            }
        }
        return $next($request); // Allow access

        // Redirect to login or unauthorized page if not an admin
    }
}
