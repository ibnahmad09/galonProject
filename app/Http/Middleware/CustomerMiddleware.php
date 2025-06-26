<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Jika belum login, arahkan ke halaman login
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }
        if (Auth::user()->role == 'customer') {
            return $next($request);
        }
        // Jika sudah login tapi bukan customer
        return redirect('/')->with('error', 'Akses ditolak!');
    }
}
