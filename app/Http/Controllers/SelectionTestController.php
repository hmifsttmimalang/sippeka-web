<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Question;
use App\Models\Registration;
use App\Models\SkillTest;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use App\Models\User;

class SelectionTestController extends Controller
{
    public function index($username)
    {
        // Set waktu saat ini dalam zona waktu yang sama
        $currentDateTime = Carbon::now('Asia/Jakarta');

        // Ambil sesi seleksi
        $sesiSeleksi = SkillTestSession::where('jenis_sesi', 'Seleksi')
            ->where('waktu_mulai', '<=', $currentDateTime)
            ->where('waktu_selesai', '>=', $currentDateTime)
            ->first();

        if (!$sesiSeleksi) {
            // Jika tidak ada sesi seleksi yang aktif, kembalikan respon kesalahan
            return redirect()->back()->with('error', 'Tidak ada sesi seleksi yang aktif saat ini.');
        }

        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        // Ambil data pendaftaran (registrasi) user dan ambil tes keahlian
        $keahlianPeserta = Registration::where('user_id', $user->id)->with('keahlian')->first();

        // Cek apakah user memiliki keahlian atau tidak
        if (!$keahlianPeserta || !$keahlianPeserta->keahlian) {
            return redirect()->back()->with('error', 'Tes keahlian tidak ditemukan untuk pengguna ini.');
        }

        // Cek apakah nilai keahlian sudah terisi
        if ($keahlianPeserta->nilai_keahlian !== null) {
            return redirect()->route('user.seleksi_selesai', ['username' => $username]);
        }

        // Ambil ID keahlian
        $keahlianId = $keahlianPeserta->keahlian;

        // Ambil tes keahlian berdasarkan ID keahlian
        $tesKeahlian = SkillTest::find($sesiSeleksi->skill_test_id);

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

        // Ambil waktu mulai dan selesai sesi dari database
        $waktuMulai = Carbon::parse($sesiSeleksi->waktu_mulai)->setTimezone('Asia/Jakarta');
        $waktuSelesai = Carbon::parse($sesiSeleksi->waktu_selesai)->setTimezone('Asia/Jakarta');

        // Hitung sisa waktu dalam detik dari sekarang hingga waktu selesai
        $remainingSeconds = $currentDateTime->diffInSeconds($waktuSelesai, false);

        // Jika sesi sudah berakhir
        if ($remainingSeconds <= 0) {
            return redirect()->route('user.waktu_seleksi_habis', ['username' => $username]);
        }

        // Tampilkan view
        return view('tes-seleksi.tes_seleksi_peserta', compact('questions', 'remainingSeconds', 'sesiSeleksi', 'username'));
    }

    public function kirimJawabanSeleksi(Request $request)
    {
        // Validasi input autentikasi
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'User tidak terautentikasi'], 401);
        }

        // Validasi input
        $request->validate([
            'userAnswers' => 'required|json',
            'skill_test_session_id' => 'required|integer',
        ]);

        $skillTestSessionId = $request->input('skill_test_session_id');
        $userAnswers = json_decode($request->input('userAnswers'), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['success' => false, 'message' => 'Error decoding JSON: ' . json_last_error_msg()], 400);
        }

        // Pastikan $userAnswers adalah array yang benar
        if (!is_array($userAnswers)) {
            return response()->json(['success' => false, 'message' => 'User Answers tidak valid'], 400);
        }

        // Membersihkan data jawaban
        foreach ($userAnswers as $questionId => &$answers) {
            $answers = array_map('trim', $answers);
        }

        // Simpan jawaban ke session
        session(['userAnswers' => $userAnswers]);

        // Hitung skor
        $questions = Question::whereIn('id', array_keys($userAnswers))->get();
        $score = 0;

        foreach ($questions as $question) {
            // Pastikan jawaban benar dibandingkan dengan jawaban yang diberikan
            if (isset($userAnswers[$question->id]) && in_array($question->jawaban_benar, $userAnswers[$question->id])) {
                $score++;
            }
        }

        $scorePercentage = count($questions) > 0 ? ($score / count($questions)) * 100 : 0;

        // Simpan nilai jawaban ke database
        Registration::where('user_id', auth()->id())->update(['nilai_keahlian' => $scorePercentage]);

        // Temukan TestAttempt yang terkait
        $registrationId = Registration::where('user_id', auth()->id())->first()->id;

        $testAttempt = TestAttempt::where('registration_id', $registrationId)
            ->where('skill_test_session_id', $skillTestSessionId)
            ->first();

        if ($testAttempt) {
            // Perbarui waktu_selesai
            $testAttempt->update([
                'status' => 'finished',
                'waktu_selesai' => Carbon::now(),
            ]);

            // Ambil data sesi tes keahlian yang terbaru
            $sesiTesKeahlian = SkillTestSession::find($skillTestSessionId);

            // Kirim data terbaru ke view
            return response()->json([
                'success' => true,
                'message' => 'Jawaban berhasil disimpan',
                'score' => $score,
                'scorePercentage' => $scorePercentage,
                'sesiTesKeahlian' => $sesiTesKeahlian,
                'testAttempt' => $testAttempt
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Test Attempt tidak ditemukan'], 404);
        }
    }

    public function tesTerkirim($username)
    {
        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        return view('tes-seleksi.tes_terkirim');
    }

    public function tesSelesai($username)
    {
        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        return view('tes-seleksi.tes_selesai');
    }

    public function waktuSeleksiHabis($username)
    {
        // Ambil user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        return view('tes-seleksi.waktu_habis');
    }
}
