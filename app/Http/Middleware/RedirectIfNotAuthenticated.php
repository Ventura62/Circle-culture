<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the request has the 'id' query parameter
        if ($request->has('id')) {
            // If the user is not authenticated
            if (!Auth::check()) {
                // Store the intended URL
                session(['intended_url' => $request->fullUrl()]);

                // Redirect to the registration page
                return redirect('/register');
            }
        }

        return $next($request);
    }
}
