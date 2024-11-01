<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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
            'keahlian' => 'required|exists:skills,id',
            'foto_identitas' => 'required|mimes:pdf,jpg,jpeg,png',
            'foto_ijazah' => 'required|mimes:pdf,jpg,jpeg,png',
            'foto_bg_biru' => 'required|mimes:jpg,jpeg,png',
        ]);
    
        // Ambil username dari user yang sedang login
        $username = auth()->user()->username;
    
        // Buat folder dengan nama username di dalam folder uploads
        $folderPath = 'uploads/' . $username;
    
        // Pastikan folder sudah ada
        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }
    
        // Mengolah data untuk nama file
        $nama = str_replace(' ', '_', $request->nama);
        $tempatLahir = str_replace(' ', '_', $request->tempat_lahir);
        $tanggalLahir = date('d-m-Y', strtotime($request->tanggal_lahir));
    
        // Menyimpan file yang diunggah
        $filePaths = []; // Menyimpan path file untuk digunakan di database

        // Simpan file Kartu Keluarga atau KTP
        if ($request->hasFile('foto_identitas')) {
            $fotoIdentitasName = "{$nama}_{$tempatLahir}_{$tanggalLahir}_foto_identitas." . $request->file('foto_identitas')->getClientOriginalExtension();
            $filePaths['foto_identitas'] = $request->file('foto_identitas')->storeAs($folderPath, $fotoIdentitasName, 'public');
        }
    
        // Simpan file Ijazah
        if ($request->hasFile('foto_ijazah')) {
            $fotoIjazahName = "{$nama}_{$tempatLahir}_{$tanggalLahir}_foto_ijazah." . $request->file('foto_ijazah')->getClientOriginalExtension();
            $filePaths['foto_ijazah'] = $request->file('foto_ijazah')->storeAs($folderPath, $fotoIjazahName, 'public');
        }
    
        // Simpan file Foto Background Biru
        if ($request->hasFile('foto_bg_biru')) {
            $fotoBgBiruName = "{$nama}_{$tempatLahir}_{$tanggalLahir}_foto_bg_biru." . $request->file('foto_bg_biru')->getClientOriginalExtension();
            $filePaths['foto_bg_biru'] = $request->file('foto_bg_biru')->storeAs($folderPath, $fotoBgBiruName, 'public');
        }
    
        // Ambil user_id dari session atau authentication
        $user_id = auth()->id();
    
        // Simpan data pendaftaran ke database
        Registration::create(array_merge($request->only(['nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'telepon', 'keahlian']), $filePaths, ['user_id' => $user_id]));
    
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
