<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;
use App\Models\Question;

class SelectionTestController extends Controller
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

        return view('tes-seleksi.tes-seleksi-peserta', compact('questions'));
    }

    public function kirimJawabanSeleksi(Request $request)
    {
        // Simpan jawaban user yang dikirim
        if ($request->has('userAnswers')) {
            $userAnswers = json_decode($request->input('userAnswers'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                // Simpan jawaban ke session, atau lakukan penyimpanan ke database
                session(['userAnswers' => $userAnswers]);

                // Hitung skor
                $questions = Question::whereIn('id', array_keys($userAnswers))->get();
                $score = 0;
                foreach ($questions as $question) {
                    if (isset($userAnswers[$question->id]) && in_array($question->jawaban_benar, $userAnswers[$question->id])) {
                        $score++;
                    }
                }
                $scorePercentage = count($questions) > 0 ? ($score / count($questions)) * 100 : 0;

                // Simpan nilai jawaban ke database
                Registration::where('user_id', auth()->id())->update(['nilai_keahlian' => $scorePercentage]);

                // Jika jawaban berhasil disimpan, kembalikan respon sukses
                return response()->json(['success' => true, 'message' => 'Jawaban berhasil disimpan', 'score' => $score, 'scorePercentage' => $scorePercentage]);
            } else {
                return response()->json(['success' => false, 'message' => 'Error decoding JSON: ' . json_last_error_msg()], 400);
            }
        }

        // Jika tidak ada jawaban yang dikirim
        return response()->json(['success' => false, 'message' => 'Tidak ada jawaban yang dikirim'], 400);
    }

    public function tesTerkirim($username)
    {
        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        return view('tes-seleksi.tes-terkirim');
    }

    public function tesSelesai($username)
    {
        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        return view('tes-seleksi.tes-selesai');
    }

    public function waktuSeleksiHabis($username)
    {
        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        return view('tes-seleksi.waktu-habis');
    }
}
