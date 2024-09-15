<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Question;
use App\Models\Registration;
use App\Models\SkillTestSession;
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

        if ($sesiSeleksi) {
            // Tidak ada tindakan yang perlu dilakukan jika sesi seleksi aktif
            Log::info('Sesi seleksi aktif.');
        } else {
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
            // Arahkan ke halaman tertentu jika nilai keahlian sudah ada
            return redirect()->route('seleksi_selesai', ['username' => $username]);
        }

        $tes_keahlian_id = $keahlianPeserta->keahlian;

        // Ambil soal berdasarkan tes_keahlian_id
        $questions = Question::where('skill_test_id', $tes_keahlian_id)->get();

        // Cek apakah soal tersedia
        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'Soal tidak tersedia untuk tes ini.');
        }

        // Ambil waktu mulai dan selesai sesi dari database
        $waktuMulai = Carbon::parse($sesiSeleksi->waktu_mulai)->setTimezone('Asia/Jakarta');
        $waktuSelesai = Carbon::parse($sesiSeleksi->waktu_selesai)->setTimezone('Asia/Jakarta');

        // Ambil waktu sekarang di timezone yang diinginkan
        $now = Carbon::now('Asia/Jakarta');

        // Hitung sisa waktu dalam detik dari sekarang hingga waktu selesai
        $remainingSeconds = $now->diffInSeconds($waktuSelesai, false);

        // Jika sesi sudah berakhir
        if ($remainingSeconds <= 0) {
            return redirect()->route('waktu_seleksi_habis', ['username' => $username]);
        }

        return view('tes-seleksi.tes-seleksi-peserta', compact('questions', 'remainingSeconds'));
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
