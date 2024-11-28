<?php

namespace App\Http\Controllers\admin\akun;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AkunPetugasContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $yazid_request)
    {
        $yazid_search = $yazid_request->input('search');
        $yazid_query = Petugas::where('level', 'petugas');

        if ($yazid_search) {
            $yazid_query->where(function($q) use ($yazid_search) {
                $q->where('nama_petugas', 'LIKE', "%{$yazid_search}%")
                  ->orWhere('username', 'LIKE', "%{$yazid_search}%");
            });
        }

        $yazid_petugas = $yazid_query->paginate(10);
        return view('admin.akun.petugas',compact('yazid_petugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.akun.add-petugas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $yazid_request)
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
    public function edit($yazid_id_petugas)
    {
        $yazid_data['yazid_petugas'] = Petugas::where('id_petugas', $yazid_id_petugas)->first();
        return view('admin.akun.edit-petugas',$yazid_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $yazid_request, $yazid_id_petugas)
    {
        $yazid_petugas = Petugas::findOrFail($yazid_id_petugas); // Ambil data petugas berdasarkan ID

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($yazid_id_petugas)
    {
        $yazid_petugas = Petugas::findOrFail($yazid_id_petugas);
        $yazid_petugas->delete();

        $yazid_idAdmin = Session::get('id_petugas');
        $yazid_namaAdmin = Session::get('nama');

        ActivityLog::create([
            'user_id' => $yazid_idAdmin,
            'user_type' => 'admin', 
            'action' => 'delete_petugas',
            'description' => "Admin : {$yazid_namaAdmin} Menghapus akun Petugas dengan nama : {$yazid_petugas->nama_petugas} (Level: {$yazid_petugas->level})",
            'ip_address' => request()->ip()
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.akun.petugas')->with('success', 'Data petugas berhasil dihapus');
    }
}
