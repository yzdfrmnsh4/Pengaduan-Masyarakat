<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{

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
        $yazid_pengaduan_baru = Pengaduan::where('status','0')->count();
        $yazid_pengaduan_proses = Pengaduan::where('status','proses')->count();
        $yazid_pengaduan_selesai = Pengaduan::where('status','selesai')->count();

        return view('admin.index' ,compact('yazid_pengaduan','yazid_total_pengaduan','yazid_pengaduan_baru','yazid_pengaduan_proses','yazid_pengaduan_selesai','yazid_chartData', 'yazid_labels'));
    }



// AdminController.php
    public function pengaduan(Request $yazid_request)
    {
        // Mulai query dasar dengan relasi
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
        
        // Debug untuk melihat jumlah data yang diambil
        // Log::info('Total Data:', ['count' => $yazid_pengaduan->count()]);
        
        return view('admin.pengaduan.baru', compact('yazid_pengaduan'));
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
        return view('admin.pengaduan.proses', compact('yazid_pengaduan'));
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
        return view('admin.pengaduan.selesai', compact('yazid_pengaduan'));
    }

    public function terima($id_pengaduan)
    {
        $yazid_pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan);
        // dd($yazid_pengaduan);
        $yazid_updateData = [
            'status' => 'proses'
        ];

        $yazid_pengaduan->update($yazid_updateData);

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'konfirmasi_pengaduan',
            'description' => "Admin : {$yazid_namaAdmin} Konfirmasi Pengaduan",
            'ip_address' => request()->ip()
        ]);

        return back()->with('success', 'Pengaduan diterima');

    }

    public function tolak($id_pengaduan)
    {
        $yazid_id = Pengaduan::where('id_pengaduan', $id_pengaduan);
        // dd($yazid_id); 

        $yazid_id->delete();

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        
        ActivityLog::create([
            'user_id' => $yazid_idAdmin,
            'user_type' => 'admin', 
            'action' => 'tolak_pengaduan',
            'description' => "Admin : {$yazid_namaAdmin} Menolak Pengaduan",
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

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        
        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'konfirmasi_pengaduan',
            'description' => "Admin : {$yazid_namaAdmin} Menyelesaikan Pengaduan",
            'ip_address' => request()->ip()
        ]);

        return back()->with('success', 'Pengaduan Selesai');

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

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        
        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'create_masyarakat',
            'description' => "Admin : {$yazid_namaAdmin} Memberikan tanggapan ",
            'ip_address' => request()->ip()
        ]);

        return response()->json(['success' => true]);

        // return redirect()->back();
    }

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

    public function activityLog(Request $yazid_request)
    {
        // $yazid_activitylogs = ActivityLog::when(request('user_type'), function($yazid_query, $yazid_userType) {
        //     return $yazid_query->where('user_type', $yazid_userType);
        // })
        // ->when(request('action'), function($yazid_query, $yazid_action) {
        //     return $yazid_query->where('action', $yazid_action);
        // })
        // ->orderBy('created_at', 'desc')
        // ->paginate(50);

        // $yazid_activitylogs = ActivityLog::orderBy('created_at','desc')->paginate(50);

        $yazid_search = $yazid_request->input('search');
        $yazid_query = ActivityLog::orderBy('created_at','desc')->latest();

        // $yazid_query = Masyarakat::where('status','verifikasi')->latest();

        if ($yazid_search) {
            $yazid_query->where(function($q) use ($yazid_search) {
                $q->where('user_type', 'LIKE', "%{$yazid_search}%")
                  ->orWhere('action', 'LIKE', "%{$yazid_search}%")
                  ->orWhere('description', 'LIKE', "%{$yazid_search}%");
            });
        }

        $yazid_activitylogs = $yazid_query->paginate(50);

        return view('admin.activityLog',compact('yazid_activitylogs'));
    }
}
