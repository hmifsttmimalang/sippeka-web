<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Registration;
use App\Models\User;
use Carbon\Carbon;
use DateTime;

class UserController extends Controller
{
    public function index($username)
    {
        // Cari user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        // Ambil pendaftar berdasarkan user_id
        $pendaftar = Registration::with('user')->where('user_id', $user->id)->first();

        if (!$pendaftar) {
            return redirect()->route('pendaftaran.form')->with('warning', 'Anda belum terdaftar. Silakan daftar terlebih dahulu');
        }

        // Ambil pengumuman terbaru dari model Pengumuman
        $pengumuman = Pengumuman::latest()->first(); // Ambil pengumuman terbaru

        $formattedAnnouncementDate = null; // Format tanggal pengumuman
        $showAnnouncement = false; // Default untuk menyembunyikan card

        // Cek apakah ada pengumuman
        if ($pengumuman) {
            $pengumumanDate = new DateTime($pengumuman->tanggal_waktu);
            $formattedAnnouncementDate = $pengumumanDate->format('d F Y H.i');

            // Ganti nama bulan ke bahasa Indonesia
            $bulanInggris = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];

            $bulanIndonesia = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];

            // Replace nama bulan Inggris dengan nama bulan Indonesia
            $formattedAnnouncementDate = str_replace($bulanInggris, $bulanIndonesia, $formattedAnnouncementDate);

            // Cek apakah tanggal saat ini sudah lewat dari tanggal pengumuman
            $currentDate = new DateTime();
            if ($currentDate >= $pengumumanDate) {
                $showAnnouncement = true; // Tampilkan card jika sudah lewat
            }
        }

        // Tanggal lahir dan format lainnya
        $tanggal_lahir = $pendaftar->tanggal_lahir;

        // Daftar bulan
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        // Ekstrak bagian tanggal
        $hari = date('d', strtotime($tanggal_lahir));
        $bulan_num = date('m', strtotime($tanggal_lahir));
        $tahun = date('Y', strtotime($tanggal_lahir));

        // Ambil nama bulan dari array
        $nama_bulan = $bulan[(int)$bulan_num];

        // Gabungkan format tanggal
        $formatted_date = $hari . ' ' . $nama_bulan . ' ' . $tahun;

        // Default values
        $nilai_keahlian = $pendaftar->nilai_keahlian ?? null;
        $nilai_wawancara = $pendaftar->nilai_wawancara ?? null;
        $rata_rata = null;
        $status = 'Sedang Diproses'; // Default status

        // Cek jika nilai keahlian dan wawancara tidak null
        if (!is_null($nilai_keahlian) && !is_null($nilai_wawancara)) {
            $rata_rata = ($nilai_keahlian + $nilai_wawancara) / 2;

            // Tentukan status berdasarkan rata-rata
            $status = ($rata_rata >= 70) ? 'Lulus' : 'Tidak Lulus';
        }

        // Kirim data user ke view dashboard
        return view('user.dashboard_user', compact('user', 'pendaftar', 'formatted_date', 'status', 'nilai_keahlian', 'nilai_wawancara', 'rata_rata', 'pengumuman', 'formattedAnnouncementDate', 'showAnnouncement'));
    }

    public function formTesSeleksi($username)
    {
        // Cari user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        $pendaftar = Registration::with('user')->where('user_id', $user->id)->first();

        return view('user.auth_tes_seleksi', compact('user', 'pendaftar'));
    }

    public function editProfil($username)
    {
        // Cari user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        $pendaftar = Registration::with('user')->where('user_id', $user->id)->first();

        return view('user.edit_profil', compact('user', 'pendaftar'));
    }

    public function updateProfil(Request $request, $username)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:8',
        ]);

        // Temukan user dan pendaftar berdasarkan username
        $user = User::where('username', $username)->firstOrFail();
        $pendaftar = Registration::where('user_id', $user->id)->firstOrFail();

        // Update data user
        $user->update([
            'email' => $validatedData['email'],
            'password' => $request->filled('password') ? bcrypt($validatedData['password']) : $user->password,
        ]);

        // Update data pendaftar
        $pendaftar->update([
            'nama' => $validatedData['nama'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'agama' => $validatedData['agama'],
            'alamat' => $validatedData['alamat'],
            'telepon' => $validatedData['telepon'],
        ]);

        // Buat folder berdasarkan username
        $folderPath = 'uploads/' . $username;

        // Ambil data nama, tempat lahir, dan tanggal lahir untuk penamaan file
        $nama = str_replace(' ', '_', $pendaftar->nama); // Ubah spasi menjadi underscore
        $tempatLahir = str_replace(' ', '_', $pendaftar->tempat_lahir); // Ubah spasi menjadi underscore
        $tanggalLahir = date('d-m-Y', strtotime($pendaftar->tanggal_lahir)); // Format tanggal

        // Helper function untuk menangani file
        function updateFile($file, $folderPath, $nama, $tempatLahir, $tanggalLahir, $existingPath = null)
        {
            $newFileName = "{$nama}_{$tempatLahir}_{$tanggalLahir}_" . basename($file->getClientOriginalName());

            // Simpan file dengan nama yang baru
            $filePath = $file->storeAs($folderPath, $newFileName, 'public');

            // Log path file yang disimpan
            Log::info("File disimpan di path: " . $filePath);

            // Hapus file lama jika ada
            if ($existingPath && Storage::disk('public')->exists($existingPath)) {
                Storage::disk('public')->delete($existingPath);
                // Log penghapusan file
                Log::info("File lama dihapus: " . $existingPath);
            }

            return $filePath;
        }

        // Update file jika ada
        if ($request->hasFile('foto_identitas')) {
            $pendaftar->foto_identitas = updateFile($request->file('foto_identitas'), $folderPath, $nama, $tempatLahir, $tanggalLahir, $pendaftar->foto_identitas);
        }
        if ($request->hasFile('foto_ijazah')) {
            $pendaftar->foto_ijazah = updateFile($request->file('foto_ijazah'), $folderPath, $nama, $tempatLahir, $tanggalLahir, $pendaftar->foto_ijazah);
        }
        if ($request->hasFile('foto_bg_biru')) {
            $pendaftar->foto_bg_biru = updateFile($request->file('foto_bg_biru'), $folderPath, $nama, $tempatLahir, $tanggalLahir, $pendaftar->foto_bg_biru);
        }

        // Simpan perubahan
        $pendaftar->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('user.dashboard', ['username' => $username])->with('success', 'Profil berhasil diperbarui!');
    }
}
