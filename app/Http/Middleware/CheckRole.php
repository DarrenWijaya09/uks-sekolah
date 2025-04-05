<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika belum login, redirect ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Jika role tidak sesuai
        if (Auth::user()->role !== $role) {
            // Jika user biasa mencoba akses admin
            if ($role === 'admin' && Auth::user()->role === 'user') {
                return redirect()->route('user.dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman admin');
            }
            // Jika admin mencoba akses user (jika diperlukan)
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        return $next($request);
    }
}