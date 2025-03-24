<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // if (!auth()->check() || (auth()->user() && !auth()->user()->hasRole($role))) {
        //     abort(403, 'Anda tidak mempunyai kebenaran untuk mengakses halaman ini.');
        // }

        if (!auth()->check() || (auth()->user() && !auth()->user()->hasRole($role))) {
            return response()->view('errors.403', [], 403);
        }        

        return $next($request);
    }
}
