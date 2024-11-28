<?php

namespace App\Http\Controllers\masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class pengaduanController extends Controller
{

    public function index()
    {
        return view('masyarakat.index');
    }

    
    public function pengaduanSaya(Request $yazid_request)
    {
        // Ambil NIK atau ID masyarakat yang login dari session
        $yazid_nik = Session::get('nik');
        
        // Ambil filter status dari request
        $yazid_statusFilter = $yazid_request->input('status', 'all');
        
        // Query untuk mengambil data pengaduan sesuai NIK dan filter status
        $yazid_query = Pengaduan::with(['masyarakat', 'tanggapan'])->where('nik', $yazid_nik);
        
        // Terapkan filter jika status tidak "all"
        if ($yazid_statusFilter !== 'all') {
            $yazid_query->where('status', $yazid_statusFilter);
        }
        
        $yazid_pengaduan = $yazid_query->paginate(3);
        
        return view('masyarakat.pengaduan', compact('yazid_pengaduan'));
    }


    public function store(Request $yazid_request)
    {
        // Validasi data yang dikirimkan
        $yazid_validatedData = $yazid_request->validate([
            'tanggal_pengaduan' => 'required|date',
            'isi_laporan' => 'required|string',
            'photo' => 'nullable|image|max:2048', // Maks 2MB per foto
        ]);

        // Ambil `nik` dari sesi atau Auth (contoh jika Anda menggunakan session)
        $yazid_nik = session('nik'); // atau bisa gunakan Auth jika sudah disesuaikan dengan model login
        // dd($nik);
        // Tangani upload foto dan simpan path-nya
        $yazid_fotoPath = null;
        if ($yazid_request->hasFile('photo')) {
            $yazid_fotoPath = $yazid_request->file('photo')->store('Pengaduan_foto', 'public');
        }

        // Buat pengaduan baru
        Pengaduan::create([
            'tgl_pengaduan' => $yazid_validatedData['tanggal_pengaduan'],
            'isi_laporan' => $yazid_validatedData['isi_laporan'],
            'nik' => $yazid_nik, // masukkan nik masyarakat yang sedang login
            'foto' => $yazid_fotoPath, // path ke foto yang diunggah
            'status' => '0', // Status default
        ]);

        // Redirect pengguna setelah pengaduan berhasil disimpan
        return redirect()->route('masyarakat.index')->with('success', 'Pengaduan berhasil disampaikan.');
    }

    /**
     * Display the specified resource.
     */
    public function profile()
    {
        $yazid_nik = Session::get('nik');

        $yazid_profile = Masyarakat::where('nik', $yazid_nik)->first();
        $yazid_pengaduan = Pengaduan::where('nik', $yazid_nik)->count();
        $yazid_pengaduan_selesai = Pengaduan::where('nik', $yazid_nik)->where('status','selesai')->count();
        $yazid_pengaduan_proses = Pengaduan::where('nik', $yazid_nik)->where('status','proses')->count();

        return view('masyarakat.profile', compact('yazid_profile','yazid_pengaduan','yazid_pengaduan_selesai','yazid_pengaduan_proses'));        
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
// Controller

    public function destroy($id_pengaduan)
    {
        // Temukan pengaduan berdasarkan id_pengaduan
        $yazid_pengaduan = Pengaduan::findOrFail($id_pengaduan);

        // Cek apakah pengaduan sudah memiliki tanggapan
        $yazid_tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();

        // Jika ada tanggapan, jangan izinkan penghapusan
        if ($yazid_tanggapan) {
            return redirect()->back()->with('error', 'Pengaduan ini sudah memiliki tanggapan dan tidak bisa dihapus.');
        }

        // Jika tidak ada tanggapan, hapus pengaduan
        $yazid_pengaduan->delete();

        // Redirect atau memberi respons sesuai kebutuhan
        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }


}
