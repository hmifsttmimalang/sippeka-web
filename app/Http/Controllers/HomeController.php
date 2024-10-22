<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() 
    {
        $user = Auth::user();

        return view('home', compact('user'));
    }

    public function infoPelatihan()
    {
        return view('informasi_pelatihan');
    }

    public function hasil()
    {
        return view('pengumuman_hasil_seleksi');
    }

    public function infoPendaftaran()
    {
        return view('tata_cara_pendaftaran');
    }
}
