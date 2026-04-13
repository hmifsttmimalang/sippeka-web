<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Registration;
use App\Models\Skill;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class RegistrationList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterSkill = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterSkill' => ['except' => ''],
    ];

    public ?int $selectedRegistrationId = null;
    public ?Registration $selectedRegistrant = null;
    public ?float $nilai_wawancara = null;
    public ?string $verification_notes = null;

    public function showProfile(int $id): void
    {
        $this->selectedRegistrationId = $id;
        $this->selectedRegistrant = Registration::with(['skill', 'user'])->findOrFail($id);
        $this->nilai_wawancara = $this->selectedRegistrant->nilai_wawancara;
        $this->verification_notes = $this->selectedRegistrant->verification_notes;

        $this->dispatch('show-profile-modal');
    }

    public function closeProfileModal(): void
    {
        $this->reset(['selectedRegistrationId', 'selectedRegistrant', 'nilai_wawancara', 'verification_notes']);
        $this->dispatch('hide-profile-modal');
    }

    public function terimaBerkas(): void
    {
        if ($this->selectedRegistrant) {
            $this->selectedRegistrant->update([
                'verification_status' => 'Approved',
                'verification_notes' => null,
            ]);
            $this->closeProfileModal();
            $this->dispatch('close-modal');
        }
    }

    public function tolakBerkas(): void
    {
        $this->validate([
            'verification_notes' => 'required|string|min:5',
        ], [
            'verification_notes.required' => 'Catatan penolakan harus diisi.'
        ]);

        if ($this->selectedRegistrant) {
            $this->selectedRegistrant->update([
                'verification_status' => 'Rejected',
                'verification_notes' => $this->verification_notes,
            ]);
            $this->closeProfileModal();
            $this->dispatch('close-modal');
        }
    }

    public function saveReview(): void
    {
        if ($this->selectedRegistrant) {
            $this->validate([
                'nilai_wawancara' => 'nullable|numeric|min:0|max:100',
            ]);

            $this->selectedRegistrant->update([
                'nilai_wawancara' => $this->nilai_wawancara,
            ]);

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
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('telepon', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterSkill, function (Builder $query) {
                $query->where('keahlian', $this->filterSkill);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.registration-list', [
            'registrants' => $registrants,
            'skills' => Skill::all(),
        ])->layout('layouts.admin_app', ['title' => 'Data Peserta Pendaftar']);
    }
}
