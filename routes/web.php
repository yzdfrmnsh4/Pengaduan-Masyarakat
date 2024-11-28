<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\akun\AkunAdminContoller;
use App\Http\Controllers\admin\akun\AkunMasyarakatContoller;
use App\Http\Controllers\admin\akun\AkunPetugasContoller;
use App\Http\Controllers\admin\akunController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\auth\loginController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\masyarakat\MasyarakatController;
use App\Http\Controllers\masyarakat\pengaduanController;
use App\Http\Controllers\petugas\petugasController;
use App\Http\Controllers\TanggapanController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/',[indexController::class,'index']);
    Route::get('/yazid_login', [loginController::class,'showLoginForm'])->name('login');
    Route::get('/yazid_register', [loginController::class,'showRegisterForm'])->name('register');
    Route::post('/register', [loginController::class, 'register'])->name('register.post');
    Route::post('/login', [loginController::class, 'login'])->name('login.post');
    Route::post('/logout', [loginController::class, 'logout'])->name('logout');    
});


Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [adminController::class,'index'])->name('admin.dashboard');   

    Route::get('/admin/profile', function () {
        return view('admin.profile',);
    })->name('profile');

    // route resource akun admin
    Route::get('/admin/akun/admin', [AkunAdminContoller::class,'index'])->name('admin.akun.admin');
    Route::get('/admin/akun/admin/add-admin',[AkunAdminContoller::class,'create'] )->name('admin.add.admin');
    Route::post('/admin/akun/add-admin',[AkunAdminContoller::class,'store'] )->name('admin.add.store');
    Route::get('/admin/akun/admin/edit/{yazid_id_petugas}',[AkunAdminContoller::class,'edit'] )->name('akun.admin.edit');    
    Route::put('/admin/akun/admin/{yazid_id_petugas}',[AkunAdminContoller::class,'update'] )->name('akun.admin.update');    
    Route::delete('/admin/akun/admin/{yazid_id_petugas}', [AkunAdminContoller::class, 'destroy'])->name('akun.admin.destroy');

    // route resource akun petugas
    Route::get('/admin/akun/petugas', [AkunPetugasContoller::class,'index'])->name('admin.akun.petugas');
    Route::get('/admin/akun/petugas/add-petugas',[AkunPetugasContoller::class,'create'] )->name('admin.add.petugas');
    Route::post('/admin/akun/add-petugas',[AkunPetugasContoller::class,'store'] )->name('petugas.add.store');
    Route::get('/admin/akun/petugas/edit/{yazid_id_petugas}',[AkunPetugasContoller::class,'edit'] )->name('akun.petugas.edit');    
    Route::put('/admin/akun/petugas/{yazid_id_petugas}',[AkunPetugasContoller::class,'update'] )->name('akun.petugas.update');    
    Route::delete('/admin/akun/petugas/{yazid_id_petugas}', [AkunPetugasContoller::class, 'destroy'])->name('akun.petugas.destroy');

    // route resource akun masyarakat
    Route::get('/admin/akun/masyarakat',[AkunMasyarakatContoller::class,'index'] )->name('admin.akun.masyarakat');    
    Route::get('/admin/akun/masyarakat/create',[AkunMasyarakatContoller::class,'create'] )->name('admin.masyarakat.create');    
    Route::post('/admin/akun/masyarakat',[AkunMasyarakatContoller::class,'store'] )->name('admin.masyarakat.store');    
    Route::get('/admin/akun/masyarakat/edit/{yazid_nik}',[AkunMasyarakatContoller::class,'edit'] )->name('akun.masyarakat.edit');    
    Route::put('/admin/akun/masyarakat/edit/{yazid_nik}',[AkunMasyarakatContoller::class,'update'] )->name('akun.masyarakat.update');    
    Route::delete('/admin/akun/masyarakat/{yazid_nik}',[AkunMasyarakatContoller::class,'destroy'] )->name('akun.masyarakat.delete');    

    Route::get('/admin/akun/masyarakat/unverified',[AkunMasyarakatContoller::class,'verifikasiAkun'] )->name('akun.masyarakat.verifikasi');    
    Route::put('/admin/akun/masyarakat/unverified/{nik}',[AkunMasyarakatContoller::class,'verifikasi'] )->name('akun.masyarakat.akunVerifikasi');    

    // route untuk pengaduan halaman admin
    Route::get('/admin/pengaduan/baru',[adminController::class,'pengaduan'] )->name('admin.pengaduan');    
    Route::get('/admin/pengaduan/proses',[adminController::class,'pengaduanProses'] )->name('admin.pengaduan.proses');
    Route::get('/admin/pengaduan/selesai', [adminController::class,'pengaduanSelesai'])->name('admin.pengaduan.done');    
    Route::post('/admin/{id_pengaduan}/terima', [adminController::class,'terima'])->name('admin.pengaduan.terima');
    Route::post('/admin/{id_pengaduan}/selesai', [adminController::class,'selesai'])->name('admin.pengaduan.selesai');

    // route untuk laporan
    Route::get('/admin/laporan',[LaporanController::class,'laporan'] )->name('admin.laporan'); 
    Route::get('/admin/laporan/filter', [LaporanController::class, 'filterLaporan'])->name('admin.laporan.filter');   
    Route::get('/admin/laporan/print-all', [LaporanController::class, 'printLaporan'])->name('admin.laporan.print-all');
    Route::get('/admin/laporan/print/{id_pengaduan}', [LaporanController::class, 'printSingleLaporan'])->name('admin.laporan.print-single');

    // route untuk mengambil detail pengaduan
    Route::get('/api/pengaduan/{id}', [adminController::class, 'getPengaduanDetail']);

    // Route untuk menangani tanggapan
    Route::get('/admin/tanggapan/{id_pengaduan}', [AdminController::class, 'getTanggapan']);
    Route::post('/admin/tanggapan', [AdminController::class, 'tanggapan'])->name('admin.tanggapan');

    Route::delete('/admin/{id_pengaduan}/tolak', [adminController::class,'tolak'])->name('admin.tolak');
    Route::get('/admin/activity-logs',[adminController::class,'activityLog'] )->name('admin.activity.log');    

});

Route::middleware([RoleMiddleware::class . ':petugas'])->group(function () {

    Route::get('/petugas/dashboard', [petugasController::class,'index'])->name('petugas.index');

    Route::get('/petugas/pengaduan', [petugasController::class,'pengaduan'])->name('petugas.pengaduan');
    Route::get('/petugas/pengaduan/proses', [petugasController::class,'pengaduanProses'])->name('petugas.pengaduan.proses');
    Route::get('/petugas/pengaduan/selesai', [petugasController::class,'pengaduanSelesai'])->name('petugas.pengaduan.done');
    Route::post('/petugas/pengaduan/{id_pengaduan}/terima', [petugasController::class, 'terima'])->name('pengaduan.terima');
    Route::delete('/petugas/{id_pengaduan}/tolak', [petugasController::class,'tolak'])->name('petugas.tolak');
    Route::post('/petugas/{id_pengaduan}/selesai', [petugasController::class,'selesai'])->name('petugas.pengaduan.selesai');


    Route::get('/petugas/tanggapan/{id_pengaduan}', [petugasController::class, 'getTanggapan']);
    Route::post('/petugas/tanggapan', [petugasController::class, 'tanggapan'])->name('admin.tanggapan');



    Route::get('/petugas/pengaduan/{id}', [petugasController::class, 'getPengaduanDetail']);
    // Route::post('/tanggapan', [petugasController::class, 'tanggapan'])->name('tanggapan.store');
});

Route::middleware([RoleMiddleware::class . ':masyarakat'])->group(function () {
    Route::get('/masyarakat/pengaduan',[pengaduanController::class,'index'])->name('masyarakat.index');
    Route::get('/masyarakat/profile',[pengaduanController::class,'profile'])->name('masyarakat.profile');
    Route::get('/masyarakat/pengaduan-saya',[pengaduanController::class,'pengaduanSaya'])->name('masyarakat.pengaduan');
    Route::post('/masyarakat/pengaduan/store',[pengaduanController::class,'store'])->name('masyarakat.store');

    Route::delete('/masyarakat/pengaduan/{id_pengaduan}', [pengaduanController::class, 'destroy'])->name('masyarakat.pengaduan.delete');

    Route::get('/masyarakat/tanggapan/{id_pengaduan}', [MasyarakatController::class, 'getTanggapan']);
    Route::post('/masyarakat/tanggapan', [MasyarakatController::class, 'tanggapan'])->name('admin.tanggapan');

});










