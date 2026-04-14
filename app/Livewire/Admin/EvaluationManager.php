<?php

namespace App\Livewire\Admin;

use App\Actions\ReviewRegistrationAction;
use App\Models\Registration;
use App\Models\Skill;
use App\Models\User;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Evaluasi Peserta')]
class EvaluationManager extends Component
{
    use WithAdminPagination;

    public string $search = '';

    public string $filterSkill = '';

    public ?int $editingId = null;

    public ?float $tempInterviewScore = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterSkill' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function editScore(int $id): void
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isInstructor()) {
            session()->flash('error', 'Hanya instruktur yang diperbolehkan mengisi nilai wawancara.');

            return;
        }

        $registration = Registration::findOrFail($id);
        $this->editingId = $id;
        $this->tempInterviewScore = $registration->interview_score;
    }

    public function saveScore(ReviewRegistrationAction $reviewRegistrationAction): void
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isInstructor()) {
            return;
        }

        $this->validate([
            'tempInterviewScore' => 'required|numeric|min:0|max:100',
        ]);

        $registration = Registration::findOrFail($this->editingId);

        $reviewRegistrationAction->updateInterviewScore($registration, $this->tempInterviewScore);

        $this->editingId = null;
        $this->tempInterviewScore = null;

        session()->flash('success', 'Nilai wawancara berhasil diperbarui.');
    }

    public function cancelEdit(): void
    {
        $this->editingId = null;
        $this->tempInterviewScore = null;
    }

    public function render(): View
    {
        $registrations = Registration::query()
            ->with(['skill', 'user'])
            ->whereNotNull('skill_score') // Only list those who have taken the test
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%'.$this->search.'%'))
            ->when($this->filterSkill, fn ($q) => $q->where('skill_id', $this->filterSkill))
            ->latest()
            ->paginate(10);

        $layout = match (Auth::user()->role) {
            'admin' => 'layouts.admin_app',
            'instructor' => 'layouts.instructor_app',
            default => 'layouts.admin_app'
        };

        /** @var mixed $view */
        $view = view('livewire.admin.evaluation-manager', [
            'registrations' => $registrations,
            'skills' => Skill::all(),
            'title' => 'Evaluasi Peserta',
        ]);

        return $view->layout($layout);
    }
}
