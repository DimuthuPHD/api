<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        $userRole = auth()->user()->role ? auth()->user()->role->name : null;

        if (! $userRole || $userRole !== $role) {
            session()->flash('error', 'You are not allowed to do this');

            return redirect()->route('dashboard')->withErrors('You are not allowed to do that');
        }

        return $next($request);
    }
}
