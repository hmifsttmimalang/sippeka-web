<?php

namespace App\Http\Controllers;

use App\Models\JadwalTes;
use App\Models\Jurusan;
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
        $jurusan = Jurusan::paginate(10);

        $statusList = [
            'dibuka' => 'Dibuka',
            'ditutup' => 'Ditutup',
        ];

        $jadwalTes = JadwalTes::with('jurusan')->paginate(10);
        return view('informasi_pelatihan', compact('jadwalTes', 'jurusan', 'statusList'));
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
}
