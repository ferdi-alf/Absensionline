<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateGuru
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna adalah guru
        if (Auth::guard('guru')->check()) {
            return $next($request);
        }

        // Jika bukan guru, arahkan ke halaman login guru
        return redirect()->route('loginguru');
    }
}