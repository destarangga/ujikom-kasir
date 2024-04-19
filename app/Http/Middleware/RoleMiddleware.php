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
    public function handle($request, Closure $next, ...$roles)
    {
        if (auth()->check()) {
            $user = auth()->user();
            // Ambil peran pengguna dari database
            $userRole = $user->role;

            // Periksa apakah peran pengguna ada di antara peran yang diizinkan
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }

        return redirect('/');
    }
}
