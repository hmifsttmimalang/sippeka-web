<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstrukturController extends Controller
{
    public function index()
    {
        $totalPendaftar = Registration::count();

        // Hitung jumlah pendaftar yang lolos seleksi (misalnya yang nilai rata-rata >= 70)
        $pendaftarLolos = Registration::whereRaw('(nilai_keahlian + nilai_wawancara) / 2 >= 70')->count();

        // Hitung progres untuk pendaftar masuk (jika lebih dari 0 maka 100%)
        $progressPendaftar = $totalPendaftar > 0 ? 100 : 0;

        // Hitung progres untuk pendaftar lolos
        $progressLolos = $totalPendaftar > 0 ? ($pendaftarLolos / $totalPendaftar) * 100 : 0;

        // Dapatkan pendaftar baru dalam 24 jam terakhir
        $listPendaftarBaru = Registration::latest()
            ->join('skills', 'registrations.keahlian', '=', 'skills.id')
            ->where('registrations.created_at', '>=', now()->subDay()) // Tentukan tabel 'registrations'
            ->select('registrations.*', 'skills.nama as keahlian_nama')
            ->paginate(10);

        return view('instruktur.dashboard', compact('totalPendaftar', 'pendaftarLolos', 'progressPendaftar', 'progressLolos', 'listPendaftarBaru'));
    }

    public function kelolaData()
    {
        // Mengambil data pendaftar dengan keahlian dan menghitung rata-rata nilai
        $listPendaftar = Registration::join('skills', 'registrations.keahlian', '=', 'skills.id')
            ->select('registrations.*', 'skills.nama as keahlian_nama', DB::raw('((registrations.nilai_keahlian + registrations.nilai_wawancara) / 2) as rata_rata'))
            ->orderByDesc('rata_rata') // Mengurutkan berdasarkan rata-rata tertinggi
            ->paginate(10); // Paginasi

        return view('instruktur.kelola_data', compact('listPendaftar'));
    }

    public function detailPendaftar($user_id)
    {
        $pendaftar = Registration::with('user')->where('user_id', $user_id)->first(); // Mengambil data berdasarkan user_id

        $tanggal_lahir = $pendaftar->tanggal_lahir;

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

        // Jika nilai keahlian ada tetapi nilai wawancara null
        if (!is_null($pendaftar->nilai_keahlian) && is_null($pendaftar->nilai_wawancara)) {
            $status = 'Sedang diproses'; // Status jika nilai wawancara belum ada
            $rataRata = null; // Tidak menghitung rata-rata
        } elseif (!is_null($pendaftar->nilai_keahlian) && !is_null($pendaftar->nilai_wawancara)) {
            // Jika kedua nilai sudah ada, hitung rata-rata
            $rataRata = ($pendaftar->nilai_keahlian + $pendaftar->nilai_wawancara) / 2;

            // Tentukan status lulus atau gagal berdasarkan nilai rata-rata
            if ($rataRata >= 70) {
                $status = 'Lulus';
            } else {
                $status = 'Gagal';
            }
        } else {
            // Jika kedua nilai belum ada
            $rataRata = null;
            $status = 'Sedang diproses';
        }

        return view('instruktur.detail_pendaftar', compact('pendaftar', 'formatted_date', 'status', 'rataRata'));
    }

    public function validasiTesWawancara(Request $request, $user_id)
    {
        // Validasi input dari form
        $request->validate([
            'nilai_wawancara' => 'required|integer|min:0|max:100', // Pastikan nilai antara 0 dan 100
        ]);

        // Temukan pendaftar berdasarkan user_id
        $pendaftar = Registration::where('user_id', $user_id)->firstOrFail();

        // Simpan nilai wawancara ke database
        $pendaftar->update([
            'nilai_wawancara' => $request->input('nilai_wawancara'),
        ]);

        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect()->route('instruktur.detail_pendaftar', $user_id)->with('success', 'Nilai wawancara berhasil divalidasi.');
    }
}
