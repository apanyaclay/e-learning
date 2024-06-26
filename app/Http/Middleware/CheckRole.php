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
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user) {
            // Redirect based on role
            if ($user->role == 'admin') {
                return redirect()->route('admin/dashboard');
            } elseif ($user->role == 'guru') {
                return redirect()->route('guru/dashboard');
            } else {
                return redirect()->route('siswa/dashboard');
            }
        }

        return $next($request);
    }
}
