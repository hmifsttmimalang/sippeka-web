<?php

namespace App\Livewire\Admin;

use App\Actions\Skills\SaveSkillAction;
use App\Models\Skill;
use App\Services\Admin\SkillService;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

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

    public function openModal(?int $id = null): void
    {
        $this->resetErrorBag();
        $this->editingId = $id;
        
        if ($id) {
            $skill = Skill::findOrFail($id);
            $this->name = $skill->name;
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

    public function save(SaveSkillAction $action): void
    {
        $this->validate();

        $action->execute($this->name, $this->editingId);

        session()->flash('message', $this->editingId ? 'Data berhasil diupdate.' : 'Data berhasil ditambah.');

        $this->closeModal();
    }

    public function delete(int $id, SkillService $service): void
    {
        try {
            $service->deleteSkill($id);
            session()->flash('message', 'Kelas berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render(SkillService $service): View
    {
        return view('livewire.admin.skill-manager', [
            'skills' => $service->getPaginatedSkills($this->search),
        ]);
    }
}
