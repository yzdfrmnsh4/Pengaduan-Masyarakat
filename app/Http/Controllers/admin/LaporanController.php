<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporan()
    {   
        $yazid_laporan = Pengaduan::all();
        return view('admin.laporan', compact('yazid_laporan'));
    }

    public function filterLaporan(Request $yazid_request)
    {
        // Buat query dasar
        $yazid_query = Pengaduan::with('masyarakat');

        // Filter berdasarkan status
        if ($yazid_request->has('status') && $yazid_request->status !== '') {
            $yazid_query->where('status', $yazid_request->status);
        }

        // Filter berdasarkan rentang tanggal
        if ($yazid_request->has('start_date') && $yazid_request->has('end_date') && 
            $yazid_request->start_date !== '' && $yazid_request->end_date !== '') {
            $yazid_query->whereBetween('tgl_pengaduan', [
                $yazid_request->start_date, 
                $yazid_request->end_date
            ]);
        }

        // Dapatkan pengaduan yang difilter
        $yazid_laporan = $yazid_query->get();

        // Kembalikan sebagai JSON untuk request AJAX
        return response()->json($yazid_laporan);
    }

    public function printSingleLaporan($id)
    {
        $yazid_laporan = Pengaduan::with('masyarakat')->where('id_pengaduan', $id)->get();
        $yazid_pdf = PDF::loadView('admin.laporan_print', compact('yazid_laporan'));
        return $yazid_pdf->download('laporan_pengaduan_' . $id . '.pdf');
    }

    public function printLaporan(Request $yazid_request)
    {
        // Buat query dasar
        $yazid_query = Pengaduan::with('masyarakat');
    
        // Filter berdasarkan status
        if ($yazid_request->filled('status')) {
            $yazid_query->where('status', $yazid_request->status);
        }
    
        // Filter berdasarkan rentang tanggal
        if ($yazid_request->filled('start_date') && $yazid_request->filled('end_date')) {
            $yazid_query->whereBetween('tgl_pengaduan', [
                $yazid_request->start_date, 
                $yazid_request->end_date
            ]);
        }
    
        // Dapatkan pengaduan yang difilter
        $yazid_laporan = $yazid_query->get();
    
        // Generate PDF
        $yazid_pdf = Pdf::loadView('admin.laporan_print', compact('yazid_laporan'));
        
        // Nama file dinamis berdasarkan filter
        $yazid_filename = 'laporan_pengaduan_';
        $yazid_filename .= $yazid_request->status ? $yazid_request->status . '_' : 'semua_';
        $yazid_filename .= $yazid_request->start_date && $yazid_request->end_date 
            ? $yazid_request->start_date . '_to_' . $yazid_request->end_date 
            : 'semua_tanggal';
        $yazid_filename .= '.pdf';
        
        return $yazid_pdf->download($yazid_filename);
    }
}
