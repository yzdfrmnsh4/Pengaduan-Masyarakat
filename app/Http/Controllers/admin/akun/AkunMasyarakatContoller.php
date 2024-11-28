<?php

namespace App\Http\Controllers\admin\akun;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AkunMasyarakatContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $yazid_request)
    {
        $yazid_search = $yazid_request->input('search');
        $yazid_query = Masyarakat::where('status','verifikasi')->latest();

        if ($yazid_search) {
            $yazid_query->where(function($q) use ($yazid_search) {
                $q->where('nama', 'LIKE', "%{$yazid_search}%")
                  ->orWhere('username', 'LIKE', "%{$yazid_search}%");
            });
        }

        $yazid_masyarakat = $yazid_query->paginate(10);

        // $yazid_data['yazid_masyarakat'] = Masyarakat::latest()->get();
        return view('admin.akun.masyarakat', compact('yazid_masyarakat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.akun.add-masyarakat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $yazid_request)
    {
        $yazid_request->validate([
            'nik' => 'required|string|unique:masyarakat,nik|size:16',
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

        $yazid_masyarakat = Masyarakat::create([
            'nik' => $yazid_request->nik,
            'nama' => $yazid_request->nama,
            'username' => $yazid_request->username,
            'password' => Hash::make($yazid_request->password),
            'telp' => $yazid_request->telp,
            'status' => 'verifikasi'
        ]);

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        
        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'create_masyarakat',
            'description' => "Admin : {$yazid_namaAdmin} Membuat akun Masyarakat dengan nama : {$yazid_masyarakat->nama} (NIK: {$yazid_masyarakat->nik})",
            'ip_address' => request()->ip()
        ]);

        return to_route('admin.akun.masyarakat')->with('success', 'Akun Masyarakat Berhasil Di Buat!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($yazid_nik)
    {
        $yazid_masyarakat = Masyarakat::where('nik', $yazid_nik)->first();
        // Melihat apakah data ditemukan
    
        $yazid_data['yazid_masyarakat'] = $yazid_masyarakat;
        return view('admin.akun.edit-masyarakat', $yazid_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $yazid_request, $yazid_nik)
    {
        $yazid_masyarakat = Masyarakat::where('nik', $yazid_nik)->firstOrFail();

        // Validasi data yang diterima
        $yazid_validatedData = $yazid_request->validate([
            'nama' => 'required|string|max:255',
            'nik' => [
                'required',
                'string',
                'max:16',
                Rule::unique('masyarakat', 'nik')->ignore($yazid_masyarakat->nik, 'nik'), // Pengecualian pada masyarakat
            ],
            'username' => [
                'required',
                'string',
                'max:25',
                Rule::unique('masyarakat', 'username')->ignore($yazid_masyarakat->username, 'username'), // Pengecualian pada masyarakat
                Rule::unique('petugas', 'username')->ignore($yazid_masyarakat->username, 'username') // Pengecualian pada petugas, dengan kolom 'username'
            ],
            'telp' => 'required|string|max:20',
        ]);

        // Siapkan data untuk update
        $yazid_updateData = [
            'nama' => $yazid_validatedData['nama'],
            'username' => $yazid_validatedData['username'],
            'telp' => $yazid_validatedData['telp'],
        ];

        // Update password jika disediakan
        if (!empty($yazid_request->password)) {
            $yazid_updateData['password'] = Hash::make($yazid_request->password);
        }

        // Lakukan update pada data masyarakat
        $yazid_masyarakat->update($yazid_updateData);

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        
        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'update_masyarakat',
            'description' => "Admin : {$yazid_namaAdmin} Update akun Masyarakat dengan nama : {$yazid_masyarakat->nama} (NIK: {$yazid_masyarakat->nik})",
            'ip_address' => request()->ip()
        ]);

        // Redirect setelah update sukses
        return redirect()->route('admin.akun.masyarakat')->with('success', 'Data masyarakat berhasil diperbarui');
    }

    public function verifikasiAkun(Request $yazid_request)
    {
        $yazid_search = $yazid_request->input('search');
        $yazid_query = Masyarakat::where('status', '0')->latest();

        // $yazid_query = Masyarakat::where('status','verifikasi')->latest();

        if ($yazid_search) {
            $yazid_query->where(function($q) use ($yazid_search) {
                $q->where('nama', 'LIKE', "%{$yazid_search}%")
                  ->orWhere('username', 'LIKE', "%{$yazid_search}%");
            });
        }

        $yazid_masyarakat = $yazid_query->paginate(10);


        return view('admin.akun.belum-verifikasi', compact('yazid_masyarakat') );
        // dd($yazid_pengaduan);
        // $yazid_masyarakat = [
        //     'status' => 'verifikasi'
        // ];

        
        // $nik->update($yazid_masyarakat);

        // return back()->with('success', 'akun di verifikasi');


    }
    public function verifikasi($nik)
    {
        $yazid_masyarakat = Masyarakat::where('nik', $nik);
        // dd($yazid_pengaduan);
        $yazid_update_data = [
            'status' => 'verifikasi'
        ];

        
        $yazid_masyarakat->update($yazid_update_data);

        return back()->with('success', 'akun di verifikasi');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($yazid_nik)
    {
        // Cari data masyarakat berdasarkan nik
        $yazid_masyarakat = Masyarakat::where('nik', $yazid_nik)->first();

        // Cek jika data masyarakat ditemukan
        if ($yazid_masyarakat) {
            // Hapus data masyarakat
            $yazid_masyarakat->delete();

            $yazid_idAdmin = Session::get('id_petugas');
            $yazid_namaAdmin = Session::get('nama');
    
            
            ActivityLog::create([
                'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
                'user_type' => 'admin', 
                'action' => 'delete_masyarakat',
                'description' => "Admin : {$yazid_namaAdmin} Menghapus akun Masyarakat dengan nama : {$yazid_masyarakat->nama} (NIK: {$yazid_masyarakat->nik})",
                'ip_address' => request()->ip()
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('admin.akun.masyarakat')->with('success', 'Data masyarakat berhasil dihapus');
        } else {
            // Jika data tidak ditemukan, redirect dengan pesan error
            return redirect()->route('admin.akun.masyarakat')->with('error', 'Data masyarakat tidak ditemukan');
        }
    }
}
