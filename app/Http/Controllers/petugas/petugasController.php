<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class petugasController extends Controller
{
    // Menu dashboard
    public function index()
    {
        $yazid_endDate = Carbon::today();
        $yazid_startDate = $yazid_endDate->copy()->subDays(6);

        $yazid_pengaduanData = Pengaduan::selectRaw('DATE(tgl_pengaduan) as date, COUNT(*) as count')
            ->whereBetween('tgl_pengaduan', [$yazid_startDate, $yazid_endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $yazid_chartData = [];
        $yazid_labels = [];

        for ($yazid_date = $yazid_startDate; $yazid_date <= $yazid_endDate; $yazid_date->addDay()) {
            $dateString = $yazid_date->toDateString();
            $yazid_labels[] = $yazid_date->format('D'); // Day name (e.g., Mon, Tue)
            $yazid_chartData[] = $yazid_pengaduanData->get($dateString)->count ?? 0;
        }

        $yazid_pengaduan = Pengaduan::latest()->take(5)->get();
        $yazid_total_pengaduan = Pengaduan::count();
        $yazid_pengaduan_baru = Pengaduan::where('status', '0')->count();
        $yazid_pengaduan_proses = Pengaduan::where('status', 'proses')->count();
        $yazid_pengaduan_selesai = Pengaduan::where('status', 'selesai')->count();
        return view('petugas.index', compact('yazid_pengaduan', 'yazid_total_pengaduan', 'yazid_pengaduan_baru', 'yazid_pengaduan_proses', 'yazid_pengaduan_selesai', 'yazid_chartData', 'yazid_labels'));
    }

    public function pengaduan(Request $yazid_request)
    {
        $yazid_query = Pengaduan::with(['masyarakat', 'tanggapan'])->where('status', '0');
        
        if ($yazid_request->filled('tanggal')) {
            $yazid_query->whereDate('tgl_pengaduan', $yazid_request->tanggal);
        }
        
        if ($yazid_request->filled('urutan')) {
            if ($yazid_request->urutan === 'terlama') {
                $yazid_query->orderBy('created_at', 'asc');
            } else {
                $yazid_query->orderBy('created_at', 'desc');
            }
        } else {
            $yazid_query->orderBy('created_at', 'desc'); // Urutan default
        }
        
        $yazid_pengaduan = $yazid_query->paginate(6);
        return view('petugas.pengaduan', compact('yazid_pengaduan'));
    }

    public function pengaduanProses(Request $yazid_request)
    {
        $yazid_query = Pengaduan::with(['masyarakat', 'tanggapan'])->where('status', 'proses');
        
        if ($yazid_request->filled('tanggal')) {
            $yazid_query->whereDate('tgl_pengaduan', $yazid_request->tanggal);
        }
        
        if ($yazid_request->filled('urutan')) {
            if ($yazid_request->urutan === 'terlama') {
                $yazid_query->orderBy('created_at', 'asc');
            } else {
                $yazid_query->orderBy('created_at', 'desc');
            }
        } else {
            $yazid_query->orderBy('created_at', 'desc'); // Urutan default
        }
        
        $yazid_pengaduan = $yazid_query->paginate(6);
        return view('petugas.pengaduan-proses', compact('yazid_pengaduan'));
    }

    public function pengaduanSelesai(Request $yazid_request)
    {
        $yazid_query = Pengaduan::with(['masyarakat', 'tanggapan'])->where('status', 'selesai');
        
        if ($yazid_request->filled('tanggal')) {
            $yazid_query->whereDate('tgl_pengaduan', $yazid_request->tanggal);
        }
        
        if ($yazid_request->filled('urutan')) {
            if ($yazid_request->urutan === 'terlama') {
                $yazid_query->orderBy('created_at', 'asc');
            } else {
                $yazid_query->orderBy('created_at', 'desc');
            }
        } else {
            $yazid_query->orderBy('created_at', 'desc'); // Urutan default
        }
        
        $yazid_pengaduan = $yazid_query->paginate(6);
        return view('petugas.pengaduan-selesai', compact('yazid_pengaduan'));
    }

    public function tolak($id_pengaduan)
    {
        $yazid_id = Pengaduan::where('id_pengaduan', $id_pengaduan);
        // dd($yazid_id); 

        $yazid_id->delete();

        $yazid_idPetugas = Session::get('id_petugas');
        $yazid_namaPetugas = Session::get('nama');


        ActivityLog::create([
            'user_id' => $yazid_idPetugas,
            'user_type' => 'petugas',
            'action' => 'tolak pengaduan',
            'description' => "petugas : {$yazid_namaPetugas} Menolak Pengaduan",
            'ip_address' => request()->ip()
        ]);

        return back()->with('success', 'Pengaduan ditolak');
    }

    public function selesai($id_pengaduan)
    {
        $yazid_pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan);
        // dd($yazid_pengaduan);
        $yazid_updateData = [
            'status' => 'selesai'
        ];

        $yazid_pengaduan->update($yazid_updateData);

        $yazid_idPetugas = Session::get('id_petugas');
        $yazid_namaPetugas = Session::get('nama');


        ActivityLog::create([
            'user_id' => $yazid_idPetugas, // ID admin yang membuat akun
            'user_type' => 'petugas',
            'action' => 'selesai pengaduan',
            'description' => "Petugas : {$yazid_namaPetugas} Menyelesaikan Pengaduan",
            'ip_address' => request()->ip()
        ]);

        return back()->with('success', 'Pengaduan selesai');
    }

    public function tanggapan(Request $yazid_request)
    {

        $yazid_request->validate([
            'id_pengaduan' => 'required|integer',
            'tanggapan' => 'required|string',
        ]);

        Tanggapan::create([
            'id_pengaduan' => $yazid_request->id_pengaduan,
            'tanggapan' => $yazid_request->tanggapan,
            'tgl_tanggapan' => now(),
            'id_petugas' => session('id_petugas'), // Menggunakan session untuk mendapatkan id_petugas
        ]);

        return response()->json(['success' => true]);
    }

    public function getTanggapan($id_pengaduan)
    {
        $yazid_tanggapan = Tanggapan::with(['petugas', 'pengaduan.masyarakat'])
            ->where('id_pengaduan', $id_pengaduan)
            ->orderBy('tgl_tanggapan', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'tanggapan' => $item->tanggapan,
                    'tgl_tanggapan' => $item->tgl_tanggapan,
                    'nama' => $item->petugas ? $item->petugas->nama_petugas : $item->pengaduan->masyarakat->nama,
                    'pengirim' => $item->petugas ? 'petugas' : 'masyarakat'
                ];
            });

        return response()->json($yazid_tanggapan);
    }



    public function getPengaduanDetail($id_pengaduan)
    {
        $yazid_pengaduan = Pengaduan::with('masyarakat') // Pastikan relasi ke masyarakat sudah terdefinisi
            ->where('id_pengaduan', $id_pengaduan)
            ->first();

        if (!$yazid_pengaduan) {
            return response()->json(['message' => 'Pengaduan tidak ditemukan'], 404);
        }

        return response()->json($yazid_pengaduan);
    }

    public function terima($id_pengaduan)
    {
        $yazid_pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan);
        // dd($yazid_pengaduan);
        $yazid_updateData = [
            'status' => 'proses'
        ];

        $yazid_pengaduan->update($yazid_updateData);

        $yazid_idPetugas = Session::get('id_petugas');
        $yazid_namaPetugas = Session::get('nama');


        ActivityLog::create([
            'user_id' => $yazid_idPetugas, // ID admin yang membuat akun
            'user_type' => 'petugas',
            'action' => 'konfirmasi_pengaduan',
            'description' => "Petugas : {$yazid_namaPetugas} Konfirmasi Pengaduan",
            'ip_address' => request()->ip()
        ]);

        return back()->with('success', 'Pengaduan diterima');
    }
}
