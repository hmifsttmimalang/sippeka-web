<?php

namespace App\Livewire\Admin;

use App\Actions\SaveSkillTestAction;
use App\Models\QuestionTitle;
use App\Models\Skill;
use App\Models\SkillTest;
use App\Services\Admin\SkillTestService;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Kelola Tes Keahlian')]
class SkillTestManager extends Component
{
    use WithAdminPagination;

    public string $search = '';

    // Form fields
    public string $name = '';

    public ?int $question_title_id = null;

    public ?int $skill_id = null;

    public int $duration_minutes = 60;

    public string $shuffle_questions = 'y';

    public string $shuffle_answers = 'y';

    public ?int $editingId = null;

    public bool $showingModal = false;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'question_title_id' => 'required|exists:question_titles,id',
        'skill_id' => 'required|exists:skills,id',
        'duration_minutes' => 'required|integer|min:1',
        'shuffle_questions' => 'required|in:y,t',
        'shuffle_answers' => 'required|in:y,t',
    ];

    public function openModal(?int $id = null): void
    {
        $this->resetErrorBag();
        $this->editingId = $id;

        if ($id) {
            $test = SkillTest::findOrFail($id);
            $this->fill($test->toArray());
        } else {
            $this->reset(['name', 'question_title_id', 'skill_id', 'duration_minutes', 'shuffle_questions', 'shuffle_answers']);
        }

        $this->showingModal = true;
    }

    public function save(SaveSkillTestAction $action): void
    {
        $this->validate();

        $action->execute($this->pull(['name', 'question_title_id', 'skill_id', 'duration_minutes', 'shuffle_questions', 'shuffle_answers']), $this->editingId);

        session()->flash('message', 'Data berhasil disimpan.');
        $this->closeModal();
    }

    public function delete(int $id, SkillTestService $service): void
    {
        try {
            $service->deleteTest($id);
            session()->flash('message', 'Tes dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render(SkillTestService $service): View
    {
        return view('livewire.admin.skill-test-manager', [
            'tests' => $service->getPaginatedTests($this->search),
            'categories_list' => QuestionTitle::all(),
            'skills_list' => Skill::all(),
        ]);
    }

    public function closeModal(): void
    {
        $this->showingModal = false;
        $this->reset('editingId');
    }
}
