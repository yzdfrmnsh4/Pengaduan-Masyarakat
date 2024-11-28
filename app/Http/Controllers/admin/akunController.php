<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Masyarakat;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class akunController extends Controller
{
    public function index()
    {
        return view('admin.daftar-akun');
    }

    // function admin
    public function admin()
    {
        $yazid_data['yazid_petugas'] = Petugas::where('level','admin')->get();
        return view('admin.akun.admin',$yazid_data);
    }

    
    public function adminCreate()
    {
        return view('admin.akun.add-admin');
    }

    public function adminEdit($id_petugas)
    {
        $yazid_data['yazid_petugas'] = Petugas::where('id_petugas', $id_petugas)->first();
       return view('admin.akun.edit-admin',$yazid_data);
    }

    
    public function adminStore(Request $yazid_request)
    {
        // dd($yazid_request->all());
        $yazid_request->validate([
            'nama_petugas' => 'required|string|max:255',
            'username' => [
                'required',
                'max:25',
                Rule::unique('masyarakat', 'username'),
                Rule::unique('petugas', 'username')
            ],
            'password' => 'required|string|min:6',
            'telp' => 'required|string|max:20',
            'level' => 'required|in:admin,petugas',
        ]);

        $yazid_petugas = Petugas::create([
            'nama_petugas' => $yazid_request->nama_petugas,
            'username' => $yazid_request->username,
            'password' => Hash::make($yazid_request->password),
            'telp' => $yazid_request->telp,
            'level' => $yazid_request->level,
        ]);

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        // Logging aktivitas pembuatan akun petugas
        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'create_admin',
            'description' => "Admin : {$yazid_namaAdmin} Membuat akun Admin dengan nama : {$yazid_petugas->nama_petugas} (Level: {$yazid_petugas->level})",
            'ip_address' => request()->ip()
        ]);
    
        return redirect()->route('admin.akun.admin')->with('success', 'Akun berhasil dibuat');

    }

    public function adminUpdate(Request $yazid_request, $id_petugas)
    {
        $yazid_petugas = Petugas::findOrFail($id_petugas); // Ambil data petugas berdasarkan ID

        $yazid_validatedData = $yazid_request->validate([
            'nama_petugas' => 'required|string|max:255',
            'username' => [
                'required',
                'max:25',
                Rule::unique('masyarakat', 'username'),
                Rule::unique('petugas', 'username')->ignore($yazid_petugas->id_petugas, 'id_petugas') // Tambahkan pengecualian untuk username saat ini
            ],
            'telp' => 'required|string|max:20',
        ]);
    
        $yazid_updateData = [
            'nama_petugas' => $yazid_validatedData['nama_petugas'],
            'username' => $yazid_validatedData['username'],
            'telp' => $yazid_validatedData['telp'],
        ];
    
        // Update password jika disediakan
        if (!empty($yazid_request->password)) {
            $yazid_updateData['password'] = Hash::make($yazid_request->password);
        }
    
        $yazid_petugas->update($yazid_updateData);

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        
        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'update_admin',
            'description' => "Admin : {$yazid_namaAdmin} Mengupdate akun Admin dengan nama : {$yazid_petugas->nama_petugas} (Level: {$yazid_petugas->level})",
            'ip_address' => request()->ip()
        ]);
    
        return redirect()->route('admin.akun.admin')->with('success', 'Data Admin berhasil diperbarui');
    }

    public function adminDelete($id_petugas)
    {
                // Cari data petugas berdasarkan ID
        $yazid_petugas = Petugas::findOrFail($id_petugas);

        // Hapus data petugas
        $yazid_petugas->delete();

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        
        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'delete_admin',
            'description' => "Admin : {$yazid_namaAdmin} Menghapus akun Admin dengan nama : {$yazid_petugas->nama_petugas} (Level: {$yazid_petugas->level})",
            'ip_address' => request()->ip()
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.akun.admin')->with('success', 'Data Admin berhasil dihapus');
    }



    // Petugas
    public function petugas()
    {
        $yazid_data['yazid_admin'] = Petugas::where('level','petugas')->get();
        return view('admin.akun.petugas',$yazid_data);
    }


    public function petugasCreate()
    {
        return view('admin.akun.add-petugas');
    }

    public function petugasStore(Request $yazid_request)
    {
        $yazid_request->validate([
            'nama_petugas' => 'required|string|max:255',
            'username' => [
                'required',
                'max:25',
                Rule::unique('masyarakat', 'username'),
                Rule::unique('petugas', 'username')
            ],
            'password' => 'required|string|min:6',
            'telp' => 'required|string|max:20',
            'level' => 'required|in:admin,petugas',
        ]);

        $yazid_petugas = Petugas::create([
            'nama_petugas' => $yazid_request->nama_petugas,
            'username' => $yazid_request->username,
            'password' => Hash::make($yazid_request->password),
            'telp' => $yazid_request->telp,
            'level' => $yazid_request->level,
        ]);

        // Ambil ID admin dari session
        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        // Logging aktivitas pembuatan akun petugas
        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'create_petugas',
            'description' => "Admin : {$yazid_namaAdmin} Membuat akun petugas dengan nama : {$yazid_petugas->nama_petugas} (Level: {$yazid_petugas->level})",
            'ip_address' => request()->ip()
        ]);
        
    
        return redirect()->route('admin.akun.petugas')->with('success', 'Akun berhasil dibuat');
    }

    public function petugasEdit($id_petugas)
    {
        $yazid_data['yazid_petugas'] = Petugas::where('id_petugas', $id_petugas)->first();
       return view('admin.akun.edit-petugas',$yazid_data);
    }

    public function petugasUpdate(Request $yazid_request, $id_petugas)
    {
        $yazid_petugas = Petugas::findOrFail($id_petugas); // Ambil data petugas berdasarkan ID

        $yazid_validatedData = $yazid_request->validate([
            'nama_petugas' => 'required|string|max:255',
            'username' => [
                'required',
                'max:25',
                Rule::unique('masyarakat', 'username'),
                Rule::unique('petugas', 'username')->ignore($yazid_petugas->id_petugas, 'id_petugas') // Tambahkan pengecualian untuk username saat ini
            ],
            'telp' => 'required|string|max:20',
        ]);
    
        $yazid_updateData = [
            'nama_petugas' => $yazid_validatedData['nama_petugas'],
            'username' => $yazid_validatedData['username'],
            'telp' => $yazid_validatedData['telp'],
        ];
    
        // Update password jika disediakan
        if (!empty($yazid_request->password)) {
            $yazid_updateData['password'] = Hash::make($yazid_request->password);
        }
    
        $yazid_petugas->update($yazid_updateData);

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        
        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'update_petugas',
            'description' => "Admin : {$yazid_namaAdmin} Mengupdate akun Petugas dengan nama : {$yazid_petugas->nama_petugas} (Level: {$yazid_petugas->level})",
            'ip_address' => request()->ip()
        ]);
    
        return redirect()->route('admin.akun.petugas')->with('success', 'Data Admin berhasil diperbarui');
    }

    public function petugasDelete($id_petugas)
    {
        $yazid_petugas = Petugas::findOrFail($id_petugas);
        // Hapus data petugas
        $yazid_petugas->delete();

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        
        ActivityLog::create([
            'user_id' => $yazid_idAdmin, // ID admin yang membuat akun
            'user_type' => 'admin', 
            'action' => 'delete_petugas',
            'description' => "Admin : {$yazid_namaAdmin} Menghapus akun Petugas dengan nama : {$yazid_petugas->nama_petugas} (Level: {$yazid_petugas->level})",
            'ip_address' => request()->ip()
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.akun.petugas')->with('success', 'Data petugas berhasil dihapus');
    }

    // MAsyarakat
    public function masyarakat()
    {
        $yazid_data['yazid_masyarakat'] = Masyarakat::latest()->get();
        return view('admin.akun.masyarakat',$yazid_data);
    }

    public function masyarakatCreate()
    {
        return view('admin.akun.add-masyarakat');
    }

    public function masyarakatStore(Request $yazid_request)
    {        
        // dd($yazid_request->all());
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
            'telp' => $yazid_request->telp
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

    public function masyarakatEdit($nik)
    {
        $yazid_masyarakat = Masyarakat::where('nik', $nik)->first();
        // Melihat apakah data ditemukan
    
        $yazid_data['yazid_masyarakat'] = $yazid_masyarakat;
        return view('admin.akun.edit-masyarakat', $yazid_data);
    }

    public function masyarakatUpdate(Request $yazid_request ,$nik)
    {
        // Ambil data masyarakat berdasarkan nik
        $yazid_masyarakat = Masyarakat::where('nik', $nik)->firstOrFail();

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

    public function masyarakatDelete($nik)
    {
        // Cari data masyarakat berdasarkan nik
        $yazid_masyarakat = Masyarakat::where('nik', $nik)->first();

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
