<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class indexController extends Controller
{
    public function index()
    {
        if (Session::has('login')) {
            return redirect()->back();
        }

        $yazid_pengaduan = Pengaduan::latest('tgl_pengaduan')
        ->take(5)
        ->get();

        return view('index', compact('yazid_pengaduan'));
    }
}
