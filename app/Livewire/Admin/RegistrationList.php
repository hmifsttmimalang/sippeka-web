<?php

namespace App\Livewire\Admin;

use App\Models\Registration;
use App\Models\Skill;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
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

    protected $queryString = [
        'search' => ['except' => ''],
        'filterSkill' => ['except' => ''],
    ];

    public ?int $selectedRegistrationId = null;

    public ?Registration $selectedRegistrant = null;

    public ?float $interview_score = null;

    public ?string $verification_notes = null;

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
        $this->reset(['selectedRegistrationId', 'selectedRegistrant', 'interview_score', 'verification_notes']);
        $this->dispatch('hide-profile-modal');
    }

    public function approveDocuments(ReviewRegistrationAction $reviewRegistrationAction): void
    {
        if ($this->selectedRegistrant) {
            $reviewRegistrationAction->updateVerification($this->selectedRegistrant, 'Approved');
            $this->closeProfileModal();
            $this->dispatch('close-modal');
        }
    }

    public function rejectDocuments(ReviewRegistrationAction $reviewRegistrationAction): void
    {
        $this->validate([
            'verification_notes' => 'required|string|min:5',
        ], [
            'verification_notes.required' => 'Catatan penolakan harus diisi.',
        ]);

        if ($this->selectedRegistrant) {
            $reviewRegistrationAction->updateVerification($this->selectedRegistrant, 'Rejected', $this->verification_notes);
            $this->closeProfileModal();
            $this->dispatch('close-modal');
        }
    }

    public function saveReview(ReviewRegistrationAction $reviewRegistrationAction): void
    {
        if ($this->selectedRegistrant) {
            $this->validate([
                'interview_score' => 'nullable|numeric|min:0|max:100',
            ]);

            $reviewRegistrationAction->updateInterviewScore($this->selectedRegistrant, $this->interview_score);

            $this->closeProfileModal();
        }
    }

    public function delete(int $id): void
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterSkill(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $registrants = Registration::query()
            ->with('skill')
            ->when($this->search, function (Builder $query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('phone', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterSkill, function (Builder $query) {
                $query->where('skill_id', $this->filterSkill);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.registration-list', [
            'registrants' => $registrants,
            'skills' => Skill::all(),
        ]);
    }
}
