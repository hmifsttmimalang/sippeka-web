<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan user login dan memiliki role 'user'
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'user') {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $skills = Skill::all();

        // Cek apakah user sudah terdaftar
        $pendaftaran = Registration::where('user_id', Auth::id())->first();
        if ($pendaftaran) {
            return redirect()->route('pendaftaran.terdaftar');
        }

        return view('pendaftaran.form-registrasi', compact('skills'));
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            'keahlian' => 'required|exists:skills,id', // Validasi bahwa keahlian harus ada di tabel skills
            'foto_ktp' => 'required|mimes:jpg,jpeg,png',
            'foto_ijazah' => 'required|mimes:jpg,jpeg,png',
            'foto_bg_biru' => 'required|mimes:jpg,jpeg,png',
            'foto_kk' => 'required|mimes:jpg,jpeg,png',
        ]);

        // Ambil username dari user yang sedang login (misalnya melalui auth)
        $username = auth()->user()->username;

        // Buat folder dengan nama username di dalam folder uploads
        $folderPath = 'uploads/' . $username;

        // Simpan file yang diunggah ke folder tersebut
        if ($request->hasFile('foto_ktp')) {
            $fotoKtpPath = $request->file('foto_ktp')->store($folderPath . '/ktp', 'public');
        }
        if ($request->hasFile('foto_ijazah')) {
            $fotoIjazahPath = $request->file('foto_ijazah')->store($folderPath . '/ijazah', 'public');
        }
        if ($request->hasFile('foto_bg_biru')) {
            $fotoBgBiruPath = $request->file('foto_bg_biru')->store($folderPath . '/bg_biru', 'public');
        }
        if ($request->hasFile('foto_kk')) {
            $fotoKkPath = $request->file('foto_kk')->store($folderPath . '/kk', 'public');
        }

        // Ambil user_id dari session atau authentication
        $user_id = auth()->id(); // Mengambil ID pengguna yang sedang login

        // Simpan data pendaftaran ke database (contoh)
        Registration::create([
            'user_id' => $user_id,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'keahlian' => $request->keahlian,
            'foto_ktp' => $fotoKtpPath,
            'foto_ijazah' => $fotoIjazahPath,
            'foto_bg_biru' => $fotoBgBiruPath,
            'foto_kk' => $fotoKkPath,
        ]);

        return redirect()->route('pendaftaran.terkirim')->with('success', 'Pendaftaran berhasil.');
    }

    public function registered()
    {
        return view('pendaftaran.terkirim');
    }
    
    public function isRegistered()
    {
        return view('pendaftaran.terdaftar');
    }
}
