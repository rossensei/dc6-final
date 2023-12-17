<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the user is authenticated
         if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Check if the user's role is 'admin'
            if ($user->roles()->first() === 'admin') {
                // Redirect admin to admin page
                return redirect()->route('admin.dashboard');
            } elseif ($user->role()->first() === 'user') {
                // Redirect user to user page
                return redirect()->route('user.dashboard');
            }
        }

        // If user is not authenticated or has an unknown role, proceed with the request
        return $next($request);
    }
}
