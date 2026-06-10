<?php

namespace App\Livewire\Student;

use App\Actions\Student\SubmitTestAttemptAction;
use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use App\Services\Student\TestSessionService;
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

    public function mount(int $sessionId, TestSessionService $service): void
    {
        $this->session = SkillTestSession::with(['test', 'test.questions'])->findOrFail($sessionId);
        $this->registration = Registration::where('user_id', Auth::id())->firstOrFail();

        // Validate session eligibility
        $error = $service->validateSession($this->session, $this->registration, 'Selection');
        if ($error) {
            redirect()->route('user.dashboard')->with('error', $error);

            return;
        }

        // Additional selection-specific check
        if ($this->registration->skill_test_score !== null) {
            redirect()->route('user.dashboard')->with('error', 'Anda sudah memiliki nilai untuk tes seleksi ini.');

            return;
        }

        // Load questions
        $loaded = $service->loadQuestions($this->session);
        $this->questions = $loaded['questions'];
        $this->shuffledOptions = $loaded['shuffledOptions'];

        // Initialize user answers
        foreach ($this->questions as $q) {
            if (! isset($this->userAnswers[$q->id])) {
                $this->userAnswers[$q->id] = null;
            }
        }

        // Initialize or resume attempt
        $attempt = $service->initializeAttempt($this->registration, $this->session);
        $this->currentAttemptId = $attempt->id;

        if ($attempt->answers) {
            $this->userAnswers = array_replace($this->userAnswers, $attempt->answers);
        }

        // Calculate timer
        $this->remainingSeconds = $service->calculateRemainingSeconds($this->session);

        if ($this->remainingSeconds <= 0) {
            $this->submit(app(SubmitTestAttemptAction::class));
        }
    }

    public function selectAnswer(int $questionId, string $option, TestSessionService $service): void
    {
        if ($this->isFinished) {
            return;
        }

        $this->userAnswers[$questionId] = $option;

        if ($this->currentAttemptId) {
            $service->saveAnswer($this->currentAttemptId, $this->userAnswers);
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

        $result = $submitAction->execute(
            $attempt,
            $this->questions,
            $this->userAnswers
        );

        $this->scorePercentage = $result['score'];

        // Update Registration Score as this is Selection
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
            'title' => 'Selection: '.$this->session->test->name,
        ]);
    }
}
