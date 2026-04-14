<?php

namespace App\Livewire\Student;

use App\Models\Question;
use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class Seleksi extends Component
{
    public SkillTestSession $session;
    public Registration $registration;
    public Collection $questions;
    public array $userAnswers = [];
    public array $shuffledOptions = [];
    public int $currentIndex = 0;
    public int $remainingSeconds = 0;
    public bool $isFinished = false;
    public ?float $scorePercentage = null;
    public ?int $currentAttemptId = null;

    public function mount(int $sessionId): void
    {
        $this->session = SkillTestSession::with(['test', 'test.questions'])->findOrFail($sessionId);
        $this->registration = Registration::where('user_id', auth()->id())->firstOrFail();

        $this->validateSession();
        $this->loadQuestions();
        $this->initializeAttempt();
        $this->calculateTimer();
    }

    private function validateSession(): void
    {
        if ($this->session->jenis_sesi !== 'Seleksi') {
            redirect()->route('user.dashboard')->with('error', 'Sesi ini bukan ujian seleksi.');
        }

        $now = Carbon::now('Asia/Jakarta');
        $mulai = Carbon::parse($this->session->waktu_mulai, 'Asia/Jakarta');
        $selesai = Carbon::parse($this->session->waktu_selesai, 'Asia/Jakarta');

        if ($now->lt($mulai)) {
            redirect()->route('user.dashboard')->with('error', 'Sesi seleksi ini belum dimulai. Silakan kembali pada jam ' . $mulai->format('H:i') . '.');
        }

        if ($now->gt($selesai)) {
            redirect()->route('user.dashboard')->with('error', 'Mohon maaf, waktu pengerjaan untuk sesi seleksi ini telah berakhir (Terlambat).');
        }

        $finishedAttempt = TestAttempt::where('registration_id', $this->registration->id)
            ->where('skill_test_session_id', $this->session->id)
            ->where('status', 'finished')
            ->exists();

        if ($finishedAttempt) {
            redirect()->route('user.dashboard')->with('error', 'Anda sudah menyelesaikan ujian seleksi ini dan tidak dapat mengulangnya.');
        }

        if ($this->registration->nilai_keahlian !== null) {
            redirect()->route('user.dashboard')->with('error', 'Anda sudah memiliki nilai untuk tes seleksi ini.');
        }
    }

    private function initializeAttempt(): void
    {
        $attempt = TestAttempt::firstOrCreate([
            'registration_id' => $this->registration->id,
            'skill_test_session_id' => $this->session->id,
            'status' => 'in_progress',
        ], [
            'waktu_mulai' => Carbon::now('Asia/Jakarta'),
            'answers' => [],
        ]);

        $this->currentAttemptId = $attempt->id;

        if ($attempt->answers) {
            $this->userAnswers = array_replace($this->userAnswers, $attempt->answers);
        }
    }

    private function loadQuestions(): void
    {
        $test = $this->session->test;
        $allQuestions = $test->questions;

        if ($test->acak_soal === 'y') {
            $allQuestions = $allQuestions->shuffle();
        }

        $this->questions = $allQuestions->map(function($q) use ($test) {
            $options = [
                'a' => $q->pilihan_a,
                'b' => $q->pilihan_b,
                'c' => $q->pilihan_c,
                'd' => $q->pilihan_d,
            ];

            if ($test->acak_jawaban === 'y') {
                $keys = array_keys($options);
                shuffle($keys);
                $shuffled = [];
                foreach($keys as $key) {
                    $shuffled[$key] = $options[$key];
                }
                $this->shuffledOptions[$q->id] = $shuffled;
            } else {
                $this->shuffledOptions[$q->id] = $options;
            }
            return $q;
        });

        foreach($this->questions as $q) {
            $this->userAnswers[$q->id] = null;
        }
    }

    private function calculateTimer(): void
    {
        $now = Carbon::now('Asia/Jakarta');
        $end = Carbon::parse($this->session->waktu_selesai, 'Asia/Jakarta');
        $this->remainingSeconds = $now->diffInSeconds($end, false);
        
        if ($this->remainingSeconds <= 0) {
            $this->submit();
        }
    }

    public function selectAnswer(int $questionId, string $option): void
    {
        if ($this->isFinished) return;
        $this->userAnswers[$questionId] = $option;

        if ($this->currentAttemptId) {
            TestAttempt::where('id', $this->currentAttemptId)->update([
                'answers' => $this->userAnswers
            ]);
        }
    }

    public function goTo(int $index): void
    {
        if (isset($this->questions[$index])) {
            $this->currentIndex = $index;
        }
    }

    public function submit()
    {
        if ($this->isFinished) return;

        $scoreCount = 0;
        $totalQuestions = $this->questions->count();

        foreach ($this->questions as $q) {
            if (isset($this->userAnswers[$q->id]) && $this->userAnswers[$q->id] === $q->jawaban_benar) {
                $scoreCount++;
            }
        }

        $this->scorePercentage = $totalQuestions > 0 ? ($scoreCount / $totalQuestions) * 100 : 0;

        $this->registration->update(['nilai_keahlian' => $this->scorePercentage]);

        TestAttempt::where('id', $this->currentAttemptId)
            ->update([
                'status' => 'finished',
                'waktu_selesai' => Carbon::now('Asia/Jakarta'),
            ]);

        $this->isFinished = true;

        session()->flash('test_result', [
            'type' => 'Seleksi',
            'test_name' => $this->session->test->nama_tes,
            'score' => $this->scorePercentage,
            'total_questions' => $totalQuestions,
            'correct_answers' => $scoreCount
        ]);

        return redirect()->route('student.dashboard');
    }

    public function exit()
    {
        redirect()->route('user.dashboard');
    }

    public function render(): View
    {
        $answeredCount = count(array_filter($this->userAnswers));
        $totalQuestions = $this->questions->count();
        $progress = $totalQuestions > 0 ? ($answeredCount / $totalQuestions) * 100 : 0;

        return view('livewire.student.seleksi', [
            'answeredCount' => $answeredCount,
            'progress' => $progress
        ])->layout('components.layouts.app', ['title' => 'Seleksi: ' . $this->session->test->nama_tes]);
    }
}
