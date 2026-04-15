<?php

namespace App\Livewire\Admin;

use App\Actions\ReviewRegistrationAction;
use App\Models\Registration;
use App\Models\Skill;
use App\Services\RegistrationService;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Data Peserta Pendaftar')]
class RegistrationList extends Component
{
    use WithAdminPagination;

    public string $search = '';
    public string $filterSkill = '';

    public ?int $selectedRegistrationId = null;
    public ?Registration $selectedRegistrant = null;
    public ?int $interview_score = null;
    public ?string $verification_notes = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterSkill' => ['except' => ''],
    ];

    public function showProfile(int $id): void
    {
        $this->selectedRegistrationId = $id;
        $this->selectedRegistrant = Registration::with(['skill', 'user'])->findOrFail($id);
        $this->interview_score = $this->selectedRegistrant->interview_score;
        $this->verification_notes = $this->selectedRegistrant->verification_notes;

        $this->dispatch('show-profile-modal');
    }

    public function closeProfileModal(): void
    {
        $this->reset([
            'selectedRegistrationId',
            'selectedRegistrant',
            'interview_score',
            'verification_notes',
        ]);
        $this->dispatch('hide-profile-modal');
    }

    public function approveDocuments(ReviewRegistrationAction $action): void
    {
        if ($this->selectedRegistrant) {
            $action->updateVerification($this->selectedRegistrant, 'Approved');
            $this->closeProfileModal();
        }
    }

    public function rejectDocuments(ReviewRegistrationAction $action): void
    {
        $this->validate(['verification_notes' => 'required|string|min:5']);

        if ($this->selectedRegistrant) {
            $action->updateVerification($this->selectedRegistrant, 'Rejected', $this->verification_notes);
            $this->closeProfileModal();
        }
    }

    public function delete(int $id, RegistrationService $service): void
    {
        $service->deleteRegistration($id);
    }

    public function render(RegistrationService $service): View
    {
        return view('livewire.admin.registration-list', [
            'registrants' => $service->getFilteredRegistrants($this->search, $this->filterSkill),
            'skills' => Skill::all(),
        ]);
    }
}
