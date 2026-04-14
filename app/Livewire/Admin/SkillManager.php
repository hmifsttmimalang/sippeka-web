<?php

namespace App\Livewire\Admin;

use App\Models\Skill;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;

#[Layout('layouts.admin_app')]
#[Title('Kelas Keahlian')]
class SkillManager extends Component
{
    use WithAdminPagination;

    public string $search = '';
    public string $name = '';
    public ?int $editingId = null;
    public bool $showingModal = false;

    protected $rules = [
        'name' => 'required|min:3|max:255',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openModal(?int $id = null): void
    {
        $this->resetErrorBag();
        $this->editingId = $id;
        $this->showingModal = true;

        if ($id) {
            $skill = Skill::findOrFail($id);
            $this->name = $skill->nama;
        } else {
            $this->name = '';
        }
    }

    public function closeModal(): void
    {
        $this->showingModal = false;
        $this->editingId = null;
    }

    public function save(): void
    {
        $this->validate();

        if ($this->editingId) {
            $skill = Skill::findOrFail($this->editingId);
            $skill->update(['nama' => $this->name]);
            session()->flash('message', 'Kelas keahlian berhasil diperbarui.');
        } else {
            Skill::create(['nama' => $this->name]);
            session()->flash('message', 'Kelas keahlian berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function delete(int $id): void
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        session()->flash('message', 'Kelas keahlian berhasil dihapus.');
    }

    public function render(): View
    {
        $skills = Skill::query()
            ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->withCount('registrations')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.skill-manager', [
            'skills' => $skills,
        ]);
}
}
