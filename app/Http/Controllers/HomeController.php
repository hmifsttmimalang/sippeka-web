<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // Mengambil data pendaftar dengan paginasi
        $listPendaftar = Registration::join('skills', 'registrations.keahlian', '=', 'skills.id')
            ->select('registrations.*', 'skills.nama as keahlian_nama', DB::raw('((registrations.nilai_keahlian + registrations.nilai_wawancara) / 2) as rata_rata'))
            ->orderByDesc('rata_rata')
            ->paginate(10); // Paginasi dilakukan di sini

        return view('pengumuman_hasil_seleksi', compact('listPendaftar'));
    }

    public function infoPendaftaran()
    {
        return view('tata_cara_pendaftaran');
    }
}
