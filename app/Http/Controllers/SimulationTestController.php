<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;
use App\Models\Question;

class SimulationTestController extends Controller
{
    public function index($username)
    {
        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        // Ambil data pendaftaran (registrasi) user dan ambil tes keahlian
        $keahlianPeserta = Registration::where('user_id', $user->id)->with('keahlian')->first();

        // Cek apakah user memiliki keahlian atau tidak
        if (!$keahlianPeserta || !$keahlianPeserta->keahlian) {
            return redirect()->back()->with('error', 'Tes keahlian tidak ditemukan untuk pengguna ini.');
        }

        $tes_keahlian_id = $keahlianPeserta->keahlian;

        // Ambil soal berdasarkan tes_keahlian_id
        $questions = Question::where('skill_test_id', $tes_keahlian_id)->get();

        // Cek apakah soal tersedia
        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'Soal tidak tersedia untuk tes ini.');
        }

        return view('tes-seleksi.tes-simulasi-peserta', compact('questions'));
    }

    public function kirimJawabanSimulasi(Request $request)
    {
        // Simpan jawaban user yang dikirim
        if ($request->has('userAnswers')) {
            $userAnswers = json_decode($request->input('userAnswers'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                // Simpan jawaban ke session, atau lakukan penyimpanan ke database
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

        // Ambil soal berdasarkan tes_keahlian_id
        $tes_keahlian_id = $keahlianPeserta->keahlian;
        $questions = Question::where('skill_test_id', $tes_keahlian_id)->get();

        // Ambil jawaban user dari sesi
        $userAnswers = session('userAnswers', []);

        // Hitung skor
        $score = 0;
        foreach ($questions as $question) {
            // Cek apakah jawaban user ada untuk soal ini
            if (isset($userAnswers[$question->id])) {
                $userAnswer = is_array($userAnswers[$question->id]) ? $userAnswers[$question->id] : explode(',', $userAnswers[$question->id]);
                // Cek apakah jawaban user benar
                if (in_array($question->jawaban_benar, $userAnswer)) {
                    $score++;
                }
            }
        }

        // Hitung persentase nilai
        $totalQuestions = $questions->count();
        $scorePercentage = $totalQuestions > 0 ? ($score / $totalQuestions) * 100 : 0;

        // Kirim data ke view
        return view('tes-seleksi.hasil-simulasi', compact('questions', 'userAnswers', 'score', 'scorePercentage'));
    }

    public function waktuSimulasiHabis()
    {
        return view('tes-seleksi.waktu-simulasi-habis');
    }
}
