<?php

namespace App\Livewire\Admin;

use App\Models\Registration;
use App\Models\Skill;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class EvaluationManager extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterSkill = '';
    public ?int $editingId = null;
    public ?float $tempNilaiWawancara = null;

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
        $registration = Registration::findOrFail($id);
        $this->editingId = $id;
        $this->tempNilaiWawancara = $registration->nilai_wawancara;
    }

    public function saveScore(): void
    {
        $this->validate([
            'tempNilaiWawancara' => 'required|numeric|min:0|max:100',
        ]);

        $registration = Registration::findOrFail($this->editingId);
        $registration->update([
            'nilai_wawancara' => $this->tempNilaiWawancara
        ]);

        $this->editingId = null;
        $this->tempNilaiWawancara = null;
        
        session()->flash('success', 'Nilai wawancara berhasil diperbarui.');
    }

    public function cancelEdit(): void
    {
        $this->editingId = null;
        $this->tempNilaiWawancara = null;
    }

    public function render(): View
    {
        $registrations = Registration::query()
            ->with(['keahlian', 'user'])
            ->whereNotNull('nilai_keahlian') // Only list those who have taken the test
            ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->when($this->filterSkill, fn($q) => $q->where('keahlian', $this->filterSkill))
            ->latest()
            ->paginate(10);

        $layout = match(auth()->user()->role) {
            'admin' => 'layouts.admin_app',
            'instruktur' => 'layouts.instruktur_app',
            default => 'layouts.admin_app'
        };

        return view('livewire.admin.evaluation-manager', [
            'registrations' => $registrations,
            'skills' => Skill::all()
        ])->layout($layout, ['title' => 'Evaluasi Peserta']);
    }
}
