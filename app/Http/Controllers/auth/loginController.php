<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Masyarakat;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class loginController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('login')) {
            return redirect()->back();
        }

        return view('auth.login');
    }
    public function showRegisterForm()
    {
        if (Session::has('login')) {
            return redirect()->back();
        }
    
        return view('auth.register');
    }

    public function login(Request $yazid_request)
    {
        $yazid_request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Cek di tabel petugas terlebih dahulu
        $yazid_petugas = Petugas::where('username', $yazid_request->username)->first();
        
        if ($yazid_petugas) {
            if (Hash::check($yazid_request->password, $yazid_petugas->password)) {

                ActivityLog::create([
                    'user_id' => $yazid_petugas->id_petugas,
                    'user_type' => $yazid_petugas->level,
                    'action' => 'login',
                    'description' => "{$yazid_petugas->nama_petugas} Login sebagai {$yazid_petugas->level} ",
                    'ip_address' => $yazid_request->ip()
                ]);

                Session::put('login', true);
                Session::put('id_petugas', $yazid_petugas->id_petugas);
                Session::put('nama', $yazid_petugas->nama_petugas);
                Session::put('level', $yazid_petugas->level); // menggunakan 'level' sesuai field di database
                
                if ($yazid_petugas->level == 'admin') {
                    return redirect('/admin/dashboard');
                }
                return redirect('/petugas/dashboard');
            }
        }

        // Jika bukan petugas, cek di tabel masyarakat
        $yazid_masyarakat = Masyarakat::where('username', $yazid_request->username)->first();

        // $yazid_status = Masyarakat::first();
        
        if ($yazid_masyarakat) {
            if (Hash::check($yazid_request->password, $yazid_masyarakat->password)) {
                Session::put('login', true);
                Session::put('nik', $yazid_masyarakat->nik);
                Session::put('nama', $yazid_masyarakat->nama);

                // dd(Session::get('status', $yazid_masyarakat->status));

                // dd($yazid_masyarakat->status);

                if ($yazid_masyarakat->status == 'verifikasi') {
                    // $yazid_request->session()->flush();
                    return redirect('/masyarakat/pengaduan');
                } elseif (Session::get('status', $yazid_masyarakat->status) == '0') {
                    $yazid_request->session()->flush();
                  return back()->with('unverifvied', 'akun anda belum di verifikasi, silahkan coba kembali');
                }
                

                // if ($yazid_masyarakat->status == 'verifikasi') {
                //     
                // }
                // Session::put('status', $yazid_status->status);
                

            }
        }

        // if ($yazid_masyarakat->status == '0') {
        //     return back()->with('unverifvied', 'akun anda belum di verifikasi');
        // }
        // return back()->with('unverifvied', 'Username atau Password salah!');
        return back()->with('error', 'Username atau Password salah!');
    }
    public function register(Request $yazid_request)
    {
        $yazid_request->validate([
            'nik' => 'required|unique:masyarakat,nik|size:16',
            'nama' => 'required|max:35',
            'username' => [
                'required',
                'max:25',
                Rule::unique('masyarakat', 'username'),
                Rule::unique('petugas', 'username')
            ],
            'password' => 'required|min:6|max:32',
            'telp' => 'required|max:13'
        ],
        [
            'nik.unique' => 'nik sudah di gunakan'
        ]

        );

        Masyarakat::create([
            'nik' => $yazid_request->nik,
            'nama' => $yazid_request->nama,
            'username' => $yazid_request->username,
            'password' => Hash::make($yazid_request->password),
            'telp' => $yazid_request->telp,
            'status' => '0'
        ]);

        return redirect('/yazid_login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $yazid_request)
    {
        // Hapus semua data sesi
        $yazid_request->session()->flush();
        $yazid_request->session()->invalidate();
        $yazid_request->session()->regenerateToken();
        return redirect('/yazid_login')->with('success', 'Berhasil logout!')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}
