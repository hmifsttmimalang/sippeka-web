<?php

namespace App\Http\Controllers;

use App\Models\QuestionTitle;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\User;
use App\Models\Registration;

class AdminController extends Controller
{
    public function kelolaData()
    {
        // Mengambil data pendaftar dengan keahlian
        $listPendaftar = Registration::latest()
            ->join('skills', 'registrations.keahlian', '=', 'skills.id')
            ->select('registrations.*', 'skills.nama as keahlian_nama')
            ->get();

        return view('admin.kelola-data', compact('listPendaftar'));
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

        return view('admin.detail-pendaftar', compact('pendaftar', 'formatted_date'));
    }

    public function peserta()
    {
        // Mengambil data pendaftar
        $listPendaftar = Registration::latest()
            ->join('skills', 'registrations.keahlian', '=', 'skills.id')
            ->select('registrations.*', 'skills.nama as keahlian_nama')
            ->get();

        return view('admin.peserta', compact('listPendaftar'));
    }

    public function infoUser()
    {
        // Mengambil semua user dengan role user
        $users = User::where('role', 'user')->get();
        return view('admin.info-user', compact('users'));
    }

    // mata soal
    public function indexMataSoal()
    {
        $mataSoal = QuestionTitle::all();
        return view('admin.mata-soal.mata-soal', compact('mataSoal'));
    }

    public function createMataSoal()
    {
        return view('admin.mata-soal.tambah-mata-soal');
    }

    public function storeMataSoal(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        $mataSoal = new QuestionTitle();
        $mataSoal->nama = $validated['nama'];
        $mataSoal->save();

        return redirect()->route('admin.mata_soal_keahlian')->with('Success', 'Mata soal berhasil ditambahkan');
    }

    public function editMataSoal($id)
    {
        $mataSoal = QuestionTitle::findOrFail($id);
        return view('admin.mata-soal.edit-mata-soal', compact('mataSoal'));
    }

    public function updateMataSoal(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $mataSoal = QuestionTitle::findOrFail($id);
        $mataSoal->nama = $validated['nama'];
        $mataSoal->save();

        return redirect()->route('admin.mata_soal_keahlian')->with('success', 'Mata soal berhasil diperbarui');
    }

    public function hapusMataSoal($id)
    {
        $mataSoal = QuestionTitle::findOrFail($id);
        $mataSoal->delete();

        return redirect()->route('admin.mata_soal_keahlian')->with('success', 'Mata soal berhasil dihapus');
    }

    // kelas keahlian
    public function indexKeahlian()
    {
        // Mengambil semua keahlian
        $keahlianList = Skill::all();
        return view('admin.keahlian.keahlian', compact('keahlianList'));
    }

    public function createKeahlian()
    {
        // Menampilkan form tambah keahlian
        return view('admin.keahlian.tambah-keahlian');
    }

    public function storeKeahlian(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Simpan keahlian baru
        $skill = new Skill;
        $skill->nama = $validated['nama'];
        $skill->save();

        return redirect()->route('kelas_keahlian.index')->with('success', 'Keahlian berhasil ditambahkan');
    }

    public function editKeahlian($id)
    {
        // Mengambil data keahlian berdasarkan id
        $keahlian = Skill::findOrFail($id);
        return view('admin.keahlian.edit-keahlian', compact('keahlian'));
    }

    public function updateKeahlian(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Update keahlian
        $keahlian = Skill::findOrFail($id);
        $keahlian->nama = $validated['nama'];
        $keahlian->save();

        return redirect()->route('kelas_keahlian.index')->with('success', 'Keahlian berhasil diperbarui');
    }

    public function destroyKeahlian($id)
    {
        // Hapus keahlian
        $keahlian = Skill::findOrFail($id);
        $keahlian->delete();

        return redirect()->route('kelas_keahlian.index')->with('success', 'Keahlian berhasil dihapus');
    }
}
