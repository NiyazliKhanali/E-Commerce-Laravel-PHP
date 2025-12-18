<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            // User is not logged in → send them to login
            return redirect()->route('login');
        }

        if (!$user->is_admin) {
            // User is not admin → send them to home or show 403 page
            return redirect()->route('home')->with('error', 'Access denied.');
        }

    return $next($request);
    }
}
