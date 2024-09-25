<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegistrationController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan user login dan memiliki role 'user'
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'user') {
                return redirect()->route('auth.login');
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

        return view('pendaftaran.form_registrasi', compact('skills'));
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
            'foto_ktp' => 'required|mimes:pdf,jpg,jpeg,png',
            'foto_ijazah' => 'required|mimes:pdf,jpg,jpeg,png',
            'foto_bg_biru' => 'required|mimes:jpg,jpeg,png',
            'foto_kk' => 'required|mimes:pdf,jpg,jpeg,png',
        ]);

        // Ambil username dari user yang sedang login (misalnya melalui auth)
        $username = auth()->user()->username;

        // Buat folder dengan nama username di dalam folder uploads
        $folderPath = 'uploads/' . $username;

        $nama = str_replace(' ', '_', $request->nama);
        $tempatLahir = str_replace(' ', '_', $request->tempat_lahir);
        $tanggalLahir = date('d-m-Y', strtotime($request->tanggal_lahir));

        // Simpan file yang diunggah ke folder tersebut
        if ($request->hasFile('foto_ktp')) {
            $fotoKtpName = "{$nama}_{$tempatLahir}_{$tanggalLahir}_foto_ktp." . $request->file('foto_ktp')->getClientOriginalExtension();
            $fotoKtpPath = $request->file('foto_ktp')->storeAs($folderPath, $fotoKtpName, 'public');
        }

        // Simpan file Ijazah
        if ($request->hasFile('foto_ijazah')) {
            $fotoIjazahName = "{$nama}_{$tempatLahir}_{$tanggalLahir}_foto_ijazah." . $request->file('foto_ijazah')->getClientOriginalExtension();
            $fotoIjazahPath = $request->file('foto_ijazah')->storeAs($folderPath, $fotoIjazahName, 'public');
        }

        // Simpan file Foto Background Biru
        if ($request->hasFile('foto_bg_biru')) {
            $fotoBgBiruName = "{$nama}_{$tempatLahir}_{$tanggalLahir}_foto_bg_biru." . $request->file('foto_bg_biru')->getClientOriginalExtension();
            $fotoBgBiruPath = $request->file('foto_bg_biru')->storeAs($folderPath, $fotoBgBiruName, 'public');
        }

        // Simpan file Kartu Keluarga
        if ($request->hasFile('foto_kk')) {
            $fotoKkName = "{$nama}_{$tempatLahir}_{$tanggalLahir}_foto_kk." . $request->file('foto_kk')->getClientOriginalExtension();
            $fotoKkPath = $request->file('foto_kk')->storeAs($folderPath, $fotoKkName, 'public');
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

        // Update status user menjadi 'terdaftar'
        User::where('id', $user_id)->update(['status_register' => 'terdaftar']);

        return redirect()->route('pendaftaran.terkirim');
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
