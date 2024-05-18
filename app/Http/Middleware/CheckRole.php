<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        $user = Auth::user();

        if ($user) {
            if ($role && !$user->hasRole($role)) {
                return abort(403, 'Unauthorized action.');
            }

            if ($user->hasRole('pengajar')) {
                return redirect('pengajar/dashboard');
            } elseif ($user->hasRole('siswa')) {
                return redirect('siswa/dashboard');
            }
        }
        return $next($request);
    }
}
