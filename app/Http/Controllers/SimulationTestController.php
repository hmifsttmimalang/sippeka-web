<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;
use App\Models\Question;
use App\Models\SkillTest;
use App\Models\SkillTestSession;

class SimulationTestController extends Controller
{
    public function index($username)
    {
        $currentDateTime = Carbon::now();

        // Cek apakah ada sesi simulasi yang sedang berlangsung
        $sesiSimulasi = SkillTestSession::where('jenis_sesi', 'Simulasi')
            ->where('waktu_mulai', '<=', $currentDateTime)
            ->where('waktu_selesai', '>=', $currentDateTime)
            ->first();

        $sesiSeleksi = SkillTestSession::where('jenis_sesi', 'Seleksi')
            ->where('waktu_mulai', '<=', $currentDateTime)
            ->where('waktu_selesai', '>=', $currentDateTime)
            ->first();

        // Jika tidak ada sesi simulasi yang sedang berlangsung, atau jika sesi seleksi aktif, blok akses
        if (!$sesiSimulasi || $sesiSeleksi) {
            return redirect()->back()->with('error', 'Simulasi tidak dapat diakses karena tidak ada sesi simulasi yang aktif atau sedang berlangsung sesi seleksi.');
        }

        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        // Ambil data pendaftaran (registrasi) user dan ambil tes keahlian
        $keahlianPeserta = Registration::where('user_id', $user->id)->with('keahlian')->first();

        // Cek apakah user memiliki keahlian atau tidak
        if (!$keahlianPeserta || !$keahlianPeserta->keahlian) {
            return redirect()->back()->with('error', 'Tes keahlian tidak ditemukan untuk pengguna ini.');
        }

        // Ambil ID keahlian
        $keahlianId = $keahlianPeserta->keahlian;  // Ini adalah ID keahlian dari registrasi pengguna

        // Ambil tes keahlian berdasarkan ID keahlian
        $tesKeahlian = SkillTest::where('keahlian', $keahlianId)->first();

        // Ambil soal berdasarkan tes_keahlian_id
        $questions = Question::where('skill_test_id', $tesKeahlian->id)->get();

        // Cek apakah soal tersedia
        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'Soal tidak tersedia untuk tes ini.');
        }

        // Acak soal jika diperlukan
        if ($tesKeahlian->acak_soal == 'y') {
            $questions = $questions->shuffle();
        }

        // Mengacak jawaban
        foreach ($questions as $question) {
            $answers = [
                'A' => $question->pilihan_a,
                'B' => $question->pilihan_b,
                'C' => $question->pilihan_c,
                'D' => $question->pilihan_d
            ];

            // Menghapus jawaban kosong
            $answers = array_filter($answers);

            // Mengacak jawaban
            $keys = array_keys($answers);
            shuffle($keys);

            $shuffledAnswers = [];
            foreach ($keys as $key) {
                $shuffledAnswers[$key] = $answers[$key];
            }

            $question->shuffled_answers = $shuffledAnswers;
        }

        return view('tes-seleksi.tes_simulasi_peserta', compact('questions'));
    }

    public function kirimJawabanSimulasi(Request $request)
    {
        // Simpan jawaban user yang dikirim
        if ($request->has('userAnswers')) {
            $userAnswers = json_decode($request->input('userAnswers'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                // Membersihkan data dari karakter ekstra
                $userAnswers = array_map(function ($answers) {
                    return array_map('trim', $answers);
                }, $userAnswers);

                // Simpan jawaban ke session
                session(['userAnswers' => $userAnswers]);

                // Jika jawaban berhasil disimpan, kembalikan respon sukses
                return response()->json(['success' => true, 'message' => 'Jawaban berhasil disimpan']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error decoding JSON: ' . json_last_error_msg()], 400);
            }
        }

        // Jika tidak ada jawaban yang dikirim
        return response()->json(['success' => false, 'message' => 'Tidak ada jawaban yang dikirim'], 400);
    }

    public function hasilSimulasi($username)
    {
        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        // Ambil data pendaftaran (registrasi) user dan tes keahlian yang diikutinya
        $keahlianPeserta = Registration::where('user_id', $user->id)->with('keahlian')->first();

        // Cek apakah user memiliki keahlian yang terkait
        if (!$keahlianPeserta || !$keahlianPeserta->keahlian) {
            return redirect()->back()->with('error', 'Tes keahlian tidak ditemukan untuk pengguna ini.');
        }
    
        // Ambil ID keahlian
        $keahlianId = $keahlianPeserta->keahlian;  // Ini adalah ID keahlian dari registrasi pengguna

        // Ambil tes keahlian berdasarkan ID keahlian
        $tesKeahlian = SkillTest::where('keahlian', $keahlianId)->first();

        // Ambil soal berdasarkan tes_keahlian_id
        $questions = Question::where('skill_test_id', $tesKeahlian->id)->get();

        // Ambil jawaban user dari sesi
        $userAnswers = session('userAnswers', []);

        // Hitung skor
        $score = 0;
        foreach ($questions as $question) {
            // Cek apakah jawaban user ada untuk soal ini
            $userAnswer = isset($userAnswers[$question->id]) ? array_map('trim', $userAnswers[$question->id]) : [];

            // Cek apakah jawaban user benar
            if (in_array($question->jawaban_benar, $userAnswer)) {
                $score++;
            }
        }

        // Hitung persentase nilai
        $totalQuestions = $questions->count();
        $scorePercentage = $totalQuestions > 0 ? ($score / $totalQuestions) * 100 : 0;

        // Kirim data ke view
        return view('tes-seleksi.hasil_simulasi', compact('questions', 'userAnswers', 'score', 'scorePercentage'));
    }

    public function waktuSimulasiHabis()
    {
        return view('tes-seleksi.waktu_simulasi_habis');
    }
}
