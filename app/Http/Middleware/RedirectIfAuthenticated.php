<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah sudah login dan halaman yang diakses adalah login atau register
        if (Session::has('login')) {
            // Jika pengguna sudah login dan mengakses halaman login atau register
            if ($request->is('login') || $request->is('register')) {
                $level = Session::get('level');
                
                // Redirect sesuai dengan level user yang sudah login
                if ($level === 'admin') {
                    return redirect('/admin/dashboard');
                } elseif ($level === 'petugas') {
                    return redirect('/petugas/dashboard');
                } elseif ($level === 'masyarakat') {
                    return redirect('/masyarakat/dashboard');
                }
            }
        }
        // Izinkan akses ke rute lain jika tidak ada sesi login
        return $next($request);
    }
}
