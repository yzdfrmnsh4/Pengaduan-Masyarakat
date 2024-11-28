<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek jika user belum login
        if (!Session::has('login')) {
            return redirect()->back()->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah role yang diinginkan adalah 'admin' atau 'petugas'
        if (($role === 'admin' || $role === 'petugas') && Session::has('id_petugas')) {
            $userLevel = Session::get('level');

            if ($role === $userLevel) {
                return $next($request);
            }

            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        // Cek jika role adalah 'masyarakat'
        if ($role === 'masyarakat' && Session::has('nik')) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini');
        // abort(404);
    }
}
