<?php

namespace App\Livewire\Student;

use App\Actions\SubmitTestAttemptAction;
use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class SelectionTest extends Component
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
        $this->registration = Registration::where('user_id', Auth::id())->firstOrFail();

        $this->validateSession();
        $this->loadQuestions();
        $this->initializeAttempt();
        $this->calculateTimer();
    }

    private function validateSession(): void
    {
        if ($this->session->session_type !== 'Selection') {
            redirect()->route('user.dashboard')->with('error', 'Sesi ini bukan ujian seleksi.');
        }

        $now = Carbon::now('Asia/Jakarta');
        $startAt = Carbon::parse($this->session->start_time, 'Asia/Jakarta');
        $endAt = Carbon::parse($this->session->end_time, 'Asia/Jakarta');

        if ($now->lt($startAt)) {
            redirect()->route('user.dashboard')->with('error', 'Sesi seleksi ini belum dimulai. Silakan kembali pada jam ' . $startAt->format('H:i') . '.');
        }

        if ($now->gt($endAt)) {
            redirect()->route('user.dashboard')->with('error', 'Mohon maaf, waktu pengerjaan untuk sesi seleksi ini telah berakhir (Terlambat).');
        }

        $finishedAttempt = TestAttempt::where('registration_id', $this->registration->id)
            ->where('skill_test_session_id', $this->session->id)
            ->where('status', 'finished')
            ->exists();

        if ($finishedAttempt) {
            redirect()->route('user.dashboard')->with('error', 'Anda sudah menyelesaikan ujian seleksi ini dan tidak dapat mengulangnya.');
        }

        if ($this->registration->skill_test_score !== null) {
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
            'start_time' => Carbon::now('Asia/Jakarta'),
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

        if ($test->shuffle_questions === 'y') {
            $allQuestions = $allQuestions->shuffle();
        }

        $this->questions = $allQuestions->map(function ($q) use ($test) {
            $options = [
                'a' => $q->option_a,
                'b' => $q->option_b,
                'c' => $q->option_c,
                'd' => $q->option_d,
            ];

            if ($test->shuffle_answers === 'y') {
                $keys = array_keys($options);
                shuffle($keys);
                $shuffled = [];
                foreach ($keys as $key) {
                    $shuffled[$key] = $options[$key];
                }
                $this->shuffledOptions[$q->id] = $shuffled;
            } else {
                $this->shuffledOptions[$q->id] = $options;
            }

            return $q;
        });

        foreach ($this->questions as $q) {
            if (!isset($this->userAnswers[$q->id])) {
                $this->userAnswers[$q->id] = null;
            }
        }
    }

    private function calculateTimer(): void
    {
        $now = Carbon::now('Asia/Jakarta');
        $end = Carbon::parse($this->session->end_time, 'Asia/Jakarta');
        $this->remainingSeconds = (int) $now->diffInSeconds($end, false);

        if ($this->remainingSeconds <= 0) {
            $this->submit(new SubmitTestAttemptAction);
        }
    }

    public function selectAnswer(int $questionId, string $option): void
    {
        if ($this->isFinished) {
            return;
        }
        $this->userAnswers[$questionId] = $option;

        if ($this->currentAttemptId) {
            TestAttempt::where('id', $this->currentAttemptId)->update([
                'answers' => $this->userAnswers,
            ]);
        }
    }

    public function goTo(int $index): void
    {
        if (isset($this->questions[$index])) {
            $this->currentIndex = $index;
        }
    }

    public function submit(SubmitTestAttemptAction $submitAction)
    {
        if ($this->isFinished) {
            return null;
        }

        $attempt = TestAttempt::findOrFail($this->currentAttemptId);

        $result = $submitAction->handle(
            $attempt,
            $this->registration,
            $this->questions,
            $this->userAnswers
        );

        $this->scorePercentage = $result['score'];

        // Update Registration Score as this is Seleksi
        $this->registration->update(['skill_test_score' => $this->scorePercentage]);

        $this->isFinished = true;

        session()->flash('test_result', [
            'type' => 'Selection',
            'test_name' => $this->session->test->name,
            'score' => $this->scorePercentage,
            'total_questions' => $result['total_questions'],
            'correct_answers' => $result['correct_answers'],
        ]);

        return redirect()->route('user.dashboard');
    }

    public function exit()
    {
        return redirect()->route('user.dashboard');
    }

    public function render(): View
    {
        $answeredCount = count(array_filter($this->userAnswers));
        $totalQuestions = $this->questions->count();
        $progress = $totalQuestions > 0 ? ($answeredCount / $totalQuestions) * 100 : 0;

        return view('livewire.student.selection-test', [
            'answeredCount' => $answeredCount,
            'progress' => $progress,
            'title' => 'Selection: ' . $this->session->test->name,
        ]);
    }
}
