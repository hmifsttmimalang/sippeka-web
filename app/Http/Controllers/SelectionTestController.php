<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\{Question, Registration, SkillTest, SkillTestSession, TestAttempt, User};

class SelectionTestController extends Controller
{
    public function index($username)
    {
        $now = Carbon::now('Asia/Jakarta');

        $sesiSeleksi = SkillTestSession::where('jenis_sesi', 'Seleksi')
            ->where('waktu_mulai', '<=', $now)
            ->where('waktu_selesai', '>=', $now)
            ->first();

        if (!$sesiSeleksi) {
            return redirect()->back()->with('error', 'Tidak ada sesi seleksi yang aktif saat ini.');
        }

        $user = User::where('username', $username)->firstOrFail();

        $registrasi = Registration::where('user_id', $user->id)->with('keahlian')->first();

        $testAttempt = TestAttempt::firstOrCreate(
            [
                'registration_id' => $registrasi->id,
                'skill_test_session_id' => $sesiSeleksi->id,
            ],
            [
                'status' => 'in_progress',
                'waktu_mulai' => $now,
            ]
        );

        if (!$registrasi || !$registrasi->keahlian) {
            return redirect()->back()->with('error', 'Tes keahlian tidak ditemukan untuk pengguna ini.');
        }

        if ($registrasi->nilai_keahlian !== null) {
            return redirect()->route('user.seleksi_selesai', ['username' => $username]);
        }

        $tesKeahlian = SkillTest::where('id', $sesiSeleksi->skill_test_id)
            ->where('keahlian', $registrasi->keahlian)
            ->first();

        if (!$tesKeahlian) {
            return redirect()->back()->with('error', 'Tes keahlian tidak ditemukan atau tidak sesuai.');
        }

        $questions = Question::where('skill_test_id', $tesKeahlian->id)->get();

        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'Soal tidak tersedia untuk tes ini.');
        }

        if ($tesKeahlian->acak_soal === 'y') {
            $questions = $questions->shuffle();
        }

        foreach ($questions as $question) {
            $answers = array_filter([
                'A' => $question->pilihan_a,
                'B' => $question->pilihan_b,
                'C' => $question->pilihan_c,
                'D' => $question->pilihan_d,
            ]);

            $keys = array_keys($answers);
            shuffle($keys);

            $shuffledAnswers = [];
            foreach ($keys as $key) {
                $shuffledAnswers[$key] = $answers[$key];
            }

            $question->shuffled_answers = $shuffledAnswers;
        }

        $remainingSeconds = $now->diffInSeconds(Carbon::parse($sesiSeleksi->waktu_selesai, 'Asia/Jakarta'), false);

        if ($remainingSeconds <= 0) {
            return redirect()->route('user.waktu_seleksi_habis', ['username' => $username]);
        }

        return view('tes-seleksi.tes_seleksi_peserta', compact('questions', 'remainingSeconds', 'sesiSeleksi', 'username'));
    }

    public function kirimJawabanSeleksi(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'User tidak terautentikasi'], 401);
        }

        $data = $request->validate([
            'userAnswers' => 'required|json',
            'skill_test_session_id' => 'required|integer',
        ]);

        $userAnswers = json_decode($data['userAnswers'], true);

        if (!is_array($userAnswers)) {
            return response()->json(['success' => false, 'message' => 'User Answers tidak valid'], 400);
        }

        foreach ($userAnswers as &$answers) {
            $answers = array_map('trim', $answers);
        }

        session(['userAnswers' => $userAnswers]);

        $questions = Question::whereIn('id', array_keys($userAnswers))->get();
        $score = $questions->filter(fn($q) => isset($userAnswers[$q->id]) && in_array($q->jawaban_benar, $userAnswers[$q->id]))->count();
        $scorePercentage = $questions->count() > 0 ? ($score / $questions->count()) * 100 : 0;

        Registration::where('user_id', auth()->id())->update(['nilai_keahlian' => $scorePercentage]);

        $registration = Registration::where('user_id', auth()->id())->first();

        $testAttempt = TestAttempt::firstOrCreate(
            [
                'registration_id' => $registration->id,
                'skill_test_session_id' => $data['skill_test_session_id'],
            ],
            [
                'status' => 'finished',
                'waktu_mulai' => Carbon::now(),
                'waktu_selesai' => Carbon::now(),
            ]
        );

        if ($testAttempt->wasRecentlyCreated === false) {
            $testAttempt->update([
                'status' => 'finished',
                'waktu_selesai' => Carbon::now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil disimpan',
            'score' => $score,
            'scorePercentage' => $scorePercentage,
            'sesiTesKeahlian' => SkillTestSession::find($data['skill_test_session_id']),
            'testAttempt' => $testAttempt,
        ]);
    }

    public function tesTerkirim($username)
    {
        User::where('username', $username)->firstOrFail();
        return view('tes-seleksi.tes_terkirim');
    }

    public function tesSelesai($username)
    {
        User::where('username', $username)->firstOrFail();
        return view('tes-seleksi.tes_selesai');
    }

    public function waktuSeleksiHabis($username)
    {
        User::where('username', $username)->firstOrFail();
        return view('tes-seleksi.waktu_habis');
    }
}
