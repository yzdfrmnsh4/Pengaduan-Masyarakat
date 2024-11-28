<?php

namespace App\Http\Controllers\masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasyarakatController extends Controller
{
    public function getTanggapan($id_pengaduan)
    {
        $yazid_tanggapan = Tanggapan::with(['petugas', 'pengaduan.masyarakat'])
            ->where('id_pengaduan', $id_pengaduan)
            ->orderBy('tgl_tanggapan', 'asc')
            ->get()
            ->map(function ($yazid_item) {
                return [
                    'id' => $yazid_item->id,
                    'tanggapan' => $yazid_item->tanggapan,
                    'tgl_tanggapan' => $yazid_item->tgl_tanggapan,
                    'nama' => $yazid_item->petugas ? $yazid_item->petugas->nama_petugas : $yazid_item->pengaduan->masyarakat->nama,
                    'pengirim' => $yazid_item->petugas ? 'petugas' : 'masyarakat'
                ];
            });
    
        return response()->json($yazid_tanggapan);
    }

    public function Tanggapan(Request $yazid_request)
    {

        $yazid_request->validate([
            'id_pengaduan' => 'required|integer',
            'tanggapan' => 'required|string',
        ]);

        Tanggapan::create([
            'id_pengaduan' => $yazid_request->id_pengaduan,
            'tanggapan' => $yazid_request->tanggapan,
            'tgl_tanggapan' => now(),
            'pengirim' => 'masyarakat',
            'nik' => session('nik'), // Menggunakan session untuk mendapatkan id_petugas
        ]);

        return response()->json(['success' => true]);
        
    }
}
