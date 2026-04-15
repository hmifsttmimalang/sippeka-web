<?php

namespace App\Livewire\Admin;

use App\Actions\Registrations\ReviewRegistrationAction;
use App\Models\Registration;
use App\Models\Skill;
use App\Models\User;
use App\Services\Admin\EvaluationService;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Evaluasi Peserta')]
class EvaluationManager extends Component
{
    use WithAdminPagination;

    public string $search = '', $filterSkill = '';
    public ?int $editingId = null;
    public ?float $tempInterviewScore = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterSkill' => ['except' => ''],
    ];

    /**
     * Edit score of registration.
     *
     * If the user is not an instructor, it will flash an error message
     * and return.
     *
     * @param int $id
     * @param EvaluationService $service
     * @return void
     */
    public function editScore(int $id, EvaluationService $service): void
    {
        if (!$service->canEvaluate()) {
            session()->flash('error', 'Cuma instruktur yang boleh ngasih nilai, bos!');
            return;
        }

        $registration = Registration::findOrFail($id);
        $this->editingId = $id;
        $this->tempInterviewScore = $registration->interview_score;
    }

    /**
     * Save the interview score of a registration.
     *
     * If the user is not an instructor, it will return without doing anything.
     *
     * @param ReviewRegistrationAction $action
     * @param EvaluationService $service
     *
     * @return void
     */
    public function saveScore(ReviewRegistrationAction $action, EvaluationService $service): void
    {
        if (!$service->canEvaluate()) return;

        $this->validate(['tempInterviewScore' => 'required|numeric|min:0|max:100']);

        $registration = Registration::findOrFail($this->editingId);
        $action->updateInterviewScore($registration, $this->tempInterviewScore);

        $this->cancelEdit();
        session()->flash('success', 'Nilai wawancara diupdate.');
    }

    /**
     * Reset the editingId and tempInterviewScore to their default values.
     *
     * This is usually called after saving a registration's interview score.
     */
    public function cancelEdit(): void
    {
        $this->reset(['editingId', 'tempInterviewScore']);
    }

    /**
     * Renders the evaluation manager view.
     *
     * @param EvaluationService $service The evaluation service which provides registrants.
     * @return View The rendered view.
     */
    public function render(EvaluationService $service): View
    {
        $layout = match (Auth::user()?->role) {
            'instructor' => 'layouts.instructor_app',
            default => 'layouts.admin_app'
        };

        return view('livewire.admin.evaluation-manager', [
            'registrations' => $service->getEvaluatableRegistrations($this->search, $this->filterSkill),
            'skills' => \App\Models\Skill::all(),
            'title' => 'Evaluasi Peserta',
        ])->layout($layout);
    }
}
