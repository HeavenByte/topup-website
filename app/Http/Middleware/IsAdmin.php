<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login DAN status role-nya adalah 'admin', izinkan lewat
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, tendang kembali ke halaman utama dengan pesan penolakan
        return redirect('/')->with('error', 'Akses ditolak! Halaman ini hanya untuk pemilik QuasarTopUp.');
    }
}
