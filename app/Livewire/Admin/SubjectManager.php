<?php

namespace App\Livewire\Admin;

use App\Actions\SaveSubjectAction;
use App\Models\QuestionTitle;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Manajemen Mata Soal')]
class SubjectManager extends Component
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
            $subject = QuestionTitle::findOrFail($id);
            $this->name = $subject->name;
        } else {
            $this->name = '';
        }
    }

    public function closeModal(): void
    {
        $this->showingModal = false;
        $this->editingId = null;
    }

    public function save(SaveSubjectAction $saveSubjectAction): void
    {
        $this->validate();

        $saveSubjectAction->execute($this->name, $this->editingId);

        session()->flash('message', $this->editingId ? 'Mata soal berhasil diperbarui.' : 'Mata soal berhasil ditambahkan.');

        $this->closeModal();
    }

    public function delete(int $id): void
    {
        $subject = QuestionTitle::findOrFail($id);
        $subject->delete();
        session()->flash('message', 'Mata soal berhasil dihapus.');
    }

    public function render(): View
    {
        $subjects = QuestionTitle::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.subject-manager', [
            'subjects' => $subjects,
        ]);
    }
}
