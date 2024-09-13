<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionTitle;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\User;
use App\Models\Registration;
use App\Models\SkillTest;

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

    // tes keahlian
    public function tesKeahlian()
    {
        $tesKeahlian = SkillTest::latest()
            ->leftJoin('skills', 'skill_tests.keahlian', '=', 'skills.id')
            ->leftJoin('question_titles', 'skill_tests.mata_soal', '=', 'question_titles.id')
            ->select('skill_tests.*', 'skills.nama as keahlian_nama', 'question_titles.nama as mata_soal_nama')
            ->get();

        return view('admin.tes-keahlian.tes-keahlian', compact('tesKeahlian'));
    }

    public function tambahTesKeahlian()
    {
        $mataSoalList = QuestionTitle::all();
        $keahlianList = Skill::all();

        return view('admin.tes-keahlian.tambah-tes-keahlian', compact('keahlianList', 'mataSoalList'));
    }

    public function simpanTesKeahlian(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_tes' => 'required|string|max:255',
            'mata_soal' => 'required|exists:question_titles,id',
            'keahlian' => 'required|exists:skills,id',
            'acak_soal' => 'required|in:y,t',
            'acak_jawaban' => 'required|in:y,t',
            'durasi_menit' => 'required|integer|min:1',
        ]);

        // Simpan data tes keahlian
        $tesKeahlian = new SkillTest;
        $tesKeahlian->nama_tes = $validated['nama_tes'];
        $tesKeahlian->mata_soal = $validated['mata_soal'];
        $tesKeahlian->keahlian = $validated['keahlian'];
        $tesKeahlian->acak_soal = $validated['acak_soal'];
        $tesKeahlian->acak_jawaban = $validated['acak_jawaban'];
        $tesKeahlian->durasi_menit = $validated['durasi_menit'];
        $tesKeahlian->save();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('admin.tes_keahlian')->with('success', 'Tes keahlian berhasil ditambahkan');
    }

    public function editTesKeahlian($id)
    {
        $tesKeahlian = SkillTest::findOrFail($id);
        $mataSoalList = QuestionTitle::all();
        $keahlianList = Skill::all();

        return view('admin.tes-keahlian.edit-tes-keahlian', compact('tesKeahlian', 'mataSoalList', 'keahlianList'));
    }

    public function updateTesKeahlian(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_tes' => 'required|string|max:255',
            'mata_soal' => 'required|exists:question_titles,id',
            'keahlian' => 'required|exists:skills,id',
            'acak_soal' => 'required|in:y,t',
            'acak_jawaban' => 'required|in:y,t',
            'durasi_menit' => 'required|integer|min:1',
        ]);

        $tesKeahlian = SkillTest::findOrFail($id);

        // Ubah data tes keahlian
        $tesKeahlian->nama_tes = $validated['nama_tes'];
        $tesKeahlian->mata_soal = $validated['mata_soal'];
        $tesKeahlian->keahlian = $validated['keahlian'];
        $tesKeahlian->acak_soal = $validated['acak_soal'];
        $tesKeahlian->acak_jawaban = $validated['acak_jawaban'];
        $tesKeahlian->durasi_menit = $validated['durasi_menit'];
        $tesKeahlian->save();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('admin.tes_keahlian')->with('success', 'Tes keahlian berhasil diubah');
    }

    public function hapusTesKeahlian($id)
    {
        $tesKeahlian = SkillTest::findOrFail($id);
        $tesKeahlian->delete();

        return redirect()->route('admin.tes_keahlian')->with('success', 'Tes keahlian berhasil dihapus');
    }

    // soal tes
    public function detailUjian($id)
    {
        // Mendapatkan tes keahlian berdasarkan ID
        $tesKeahlian = SkillTest::where('skill_tests.id', $id)
            ->leftJoin('skills', 'skill_tests.keahlian', '=', 'skills.id')
            ->leftJoin('question_titles', 'skill_tests.mata_soal', '=', 'question_titles.id')
            ->select('skill_tests.*', 'skills.nama as keahlian_nama', 'question_titles.nama as mata_soal_nama')
            ->first();

        // Jika tidak ditemukan, redirect dengan pesan error
        if (!$tesKeahlian) {
            return redirect()->route('admin.tes-keahlian')->with('error', 'Tes keahlian tidak ditemukan.');
        }

        // Mengambil soal berdasarkan skill_test_id dari $tesKeahlian
        $soal = Question::where('skill_test_id', $tesKeahlian->id)->get();

        // Menghitung jumlah soal berdasarkan skill_test_id dari $tesKeahlian
        $jumlahSoal = Question::where('skill_test_id', $tesKeahlian->id)->count();

        // Mengirimkan data ke view
        return view('admin.tes-keahlian.soal-tes.detail-tes-keahlian', compact('tesKeahlian', 'soal', 'jumlahSoal'));
    }

    public function tambahSoalTesKeahlian($id)
    {
        $tesKeahlian = SkillTest::findOrFail($id);

        return view('admin.tes-keahlian.soal-tes.tambah-soal-tes-keahlian', compact('tesKeahlian'));
    }

    public function simpanSoalTesKeahlian(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'soal' => 'required',
            'pilihan_a' => 'required',
            'pilihan_b' => 'required',
            'pilihan_c' => 'required',
            'pilihan_d' => 'required',
            'jawaban_benar' => 'required|in:A,B,C,D'
        ]);

        // Simpan soal ke dalam database
        $soal = new Question();
        $soal->skill_test_id = $id; // Menghubungkan soal dengan tes keahlian
        $soal->soal = $validated['soal'];
        $soal->pilihan_a = $validated['pilihan_a'];
        $soal->pilihan_b = $validated['pilihan_b'];
        $soal->pilihan_c = $validated['pilihan_c'];
        $soal->pilihan_d = $validated['pilihan_d'];
        $soal->jawaban_benar = $validated['jawaban_benar'];
        $soal->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.detail-ujian', ['id' => $id])->with('success', 'Soal berhasil ditambahkan');
    }

    public function importSoalTesKeahlian($id)
    {
        $tesKeahlian = SkillTest::findOrFail($id);

        return view('admin.tes-keahlian.soal-tes.import-soal-tes-keahlian', compact('tesKeahlian'));
    }

    public function editSoalTesKeahlian($id, $soal_id)
    {
        $tesKeahlian = SkillTest::findOrFail($id);
        $soal = Question::findOrFail($soal_id);

        return view('admin.tes-keahlian.soal-tes.edit-soal-tes-keahlian', compact('tesKeahlian', 'soal'));
    }

    public function updateSoalTesKeahlian(Request $request, $id, $soal_id)
    {
        // Validasi input
        $validated = $request->validate([
            'soal' => 'required',
            'pilihan_a' => 'required',
            'pilihan_b' => 'required',
            'pilihan_c' => 'required',
            'pilihan_d' => 'required',
            'jawaban_benar' => 'required|in:A,B,C,D'
        ]);

        // Simpan soal ke dalam database
        $soal = Question::findOrFail($soal_id);
        $soal->skill_test_id = $id; // Menghubungkan soal dengan tes keahlian
        $soal->soal = $validated['soal'];
        $soal->pilihan_a = $validated['pilihan_a'];
        $soal->pilihan_b = $validated['pilihan_b'];
        $soal->pilihan_c = $validated['pilihan_c'];
        $soal->pilihan_d = $validated['pilihan_d'];
        $soal->jawaban_benar = $validated['jawaban_benar'];
        $soal->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.detail-ujian', ['id' => $id])->with('success', 'Soal berhasil diubah');
    }

    public function hapusSoalTesKeahlian($id, $soal_id)
    {
        $tesKeahlian = SkillTest::findOrFail($id);
        $soal = Question::findOrFail($soal_id);

        $soal->delete();
    
        // Redirect ke halaman detail ujian dengan skill_test_id
        return redirect()->route('admin.detail-ujian', ['id' => $tesKeahlian])->with('success', 'Soal berhasil dihapus');
    }    
}
