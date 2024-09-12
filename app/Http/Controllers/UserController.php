<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\User;

class UserController extends Controller
{
    public function index($username)
    {
        // Cari user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        $pendaftar = Registration::with('user')->where('user_id', $user->id)->first();

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

        // Mengirim data user ke view dashboard
        return view('user.dashboard-user', compact('user', 'pendaftar', 'formatted_date'));
    }
}
