<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function store(Request $request, $id_pengaduan)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);
    
        // Ambil data dari session
        $userSession = session('user');
        $pengirim = $userSession['level'] === 'petugas' ? 'petugas' : 'masyarakat';
        $id_petugas = $pengirim === 'petugas' ? $userSession['id_petugas'] : null;
        $nik = $pengirim === 'masyarakat' ? $userSession['nik'] : null;
    
        Tanggapan::create([
            'id_pengaduan' => $id_pengaduan,
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->input('tanggapan'),
            'id_petugas' => $id_petugas,
            'nik' => $nik,
            'pengirim' => $pengirim,
        ]);
    
        return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan.');
    }
    
    


    public function getTanggapan($id_pengaduan)
    {
        $tanggapan = Tanggapan::with(['petugas', 'masyarakat'])
            ->where('id_pengaduan', $id_pengaduan)
            ->orderBy('created_at', 'asc')
            ->get();

        // Tambahkan informasi current user untuk frontend
        $currentUser = [
            'type' => session()->has('petugas') ? 'petugas' : 'masyarakat',
            'id' => session()->has('petugas') 
                ? session('petugas')->id_petugas 
                : session('masyarakat')->nik
        ];

        return response()->json([
            'tanggapan' => $tanggapan,
            'currentUser' => $currentUser
        ]);
    }
    
}
