<?php

namespace App\Livewire\Admin;

use App\Actions\SaveSubjectAction;
use App\Models\QuestionTitle;
use App\Services\Admin\SubjectService;
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

    public function openModal(?int $id = null): void
    {
        $this->resetErrorBag();
        $this->editingId = $id;
        
        if ($id) {
            $subject = QuestionTitle::findOrFail($id);
            $this->name = $subject->name;
        } else {
            $this->reset('name');
        }

        $this->showingModal = true;
    }

    public function closeModal(): void
    {
        $this->showingModal = false;
        $this->reset(['editingId', 'name']);
    }

    public function save(SaveSubjectAction $action): void
    {
        $this->validate();

        $action->execute($this->name, $this->editingId);

        session()->flash('message', $this->editingId ? 'Mata soal diperbarui.' : 'Mata soal ditambah.');

        $this->closeModal();
    }

    public function delete(int $id, SubjectService $service): void
    {
        try {
            $service->deleteSubject($id);
            session()->flash('message', 'Mata soal dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render(SubjectService $service): View
    {
        return view('livewire.admin.subject-manager', [
            'subjects' => $service->getPaginatedSubjects($this->search),
        ]);
    }
}
