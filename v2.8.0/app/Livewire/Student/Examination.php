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

class Examination extends Component
{
    public SkillTestSession $session;
    public Registration $registration;
    public Collection $questions;
    public array $userAnswers = [];
    public int $currentIndex = 0;
    public int $remainingSeconds = 0;
    public bool $isFinished = false;
    public ?float $scorePercentage = null;

    public function mount(int $sessionId): void
    {
        $this->session = SkillTestSession::with(['test', 'test.questions'])->findOrFail($sessionId);
        $this->registration = Registration::where('user_id', auth()->id())->firstOrFail();

        // Security checks
        $this->validateSession();

        // Initialize Attempt
        $this->initializeAttempt();

        // Load and Prepare Questions
        $this->loadQuestions();

        // Calculate Timer
        $this->calculateTimer();
    }

    private function validateSession(): void
    {
        $now = Carbon::now('Asia/Jakarta');
        if ($now->lt($this->session->waktu_mulai) || $now->gt($this->session->waktu_selesai)) {
            redirect()->route('student.dashboard')->with('error', 'Sesi ujian tidak aktif.');
        }

        // Only block if it's a 'Seleksi' and already finished
        if ($this->session->jenis_sesi === 'Seleksi' && $this->registration->nilai_keahlian !== null) {
            redirect()->route('student.dashboard')->with('error', 'Anda sudah menyelesaikan tes seleksi ini.');
        }

        // If 'Simulasi', we allow multiple attempts unless specific session rules apply
    }

    private function initializeAttempt(): void
    {
        TestAttempt::create([
            'registration_id' => $this->registration->id,
            'skill_test_session_id' => $this->session->id,
            'status' => 'in_progress',
            'waktu_mulai' => Carbon::now('Asia/Jakarta'),
        ]);
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
                $q->shuffled_options = $shuffled;
            } else {
                $q->shuffled_options = $options;
            }
            return $q;
        });

        // Initialize userAnswers array with nulls
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
    }

    public function goTo(int $index): void
    {
        if (isset($this->questions[$index])) {
            $this->currentIndex = $index;
        }
    }

    public function submit(): void
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

        // Update Registration Score ONLY if it's 'Seleksi'
        if ($this->session->jenis_sesi === 'Seleksi') {
            $this->registration->update(['nilai_keahlian' => $this->scorePercentage]);
        }

        // Update Attempt
        TestAttempt::where('registration_id', $this->registration->id)
            ->where('skill_test_session_id', $this->session->id)
            ->where('status', 'in_progress')
            ->latest()
            ->first()
            ->update([
                'status' => 'finished',
                'waktu_selesai' => Carbon::now('Asia/Jakarta'),
            ]);

        $this->isFinished = true;

        if ($this->session->jenis_sesi === 'Seleksi') {
            session()->flash('success', 'Ujian Seleksi berhasil diselesaikan.');
            redirect()->route('student.dashboard');
        }
    }

    public function exit(): void
    {
        redirect()->route('student.dashboard');
    }

    public function render(): View
    {
        return view('livewire.student.examination')
            ->layout('components.layouts.app', ['title' => 'Ujian: ' . $this->session->test->nama_tes]);
    }
}
