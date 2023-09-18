<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Periksa apakah pengguna ada
        if (!$request->user()) {
            abort(403, 'Unauthorized');
        }

        // Periksa apakah peran pengguna ada dalam daftar peran yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            if ($request->user()->role === 'superadmin') {
                return redirect('/dashboard');
            } elseif ($request->user()->role === 'admin') {
                return redirect('/dashboardadmin');
            } else {
                abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }


}
