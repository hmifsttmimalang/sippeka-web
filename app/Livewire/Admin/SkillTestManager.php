<?php

namespace App\Livewire\Admin;

use App\Actions\SaveSkillTestAction;
use App\Models\QuestionTitle;
use App\Models\Skill;
use App\Models\SkillTest;
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
            $test = SkillTest::findOrFail($id);
            $this->name = $test->name;
            $this->question_title_id = $test->question_title_id;
            $this->skill_id = $test->skill_id;
            $this->duration_minutes = $test->duration_minutes;
            $this->shuffle_questions = $test->shuffle_questions;
            $this->shuffle_answers = $test->shuffle_answers;
        } else {
            $this->reset(['name', 'question_title_id', 'skill_id', 'duration_minutes', 'shuffle_questions', 'shuffle_answers']);
        }
    }

    public function closeModal(): void
    {
        $this->showingModal = false;
        $this->editingId = null;
    }

    public function save(SaveSkillTestAction $saveSkillTestAction): void
    {
        $this->validate();

        $saveSkillTestAction->execute([
            'name' => $this->name,
            'question_title_id' => $this->question_title_id,
            'skill_id' => $this->skill_id,
            'duration_minutes' => $this->duration_minutes,
            'shuffle_questions' => $this->shuffle_questions,
            'shuffle_answers' => $this->shuffle_answers,
        ], $this->editingId);

        session()->flash('message', $this->editingId ? 'Tes keahlian berhasil diperbarui.' : 'Tes keahlian berhasil ditambahkan.');

        $this->closeModal();
    }

    public function delete(int $id): void
    {
        $test = SkillTest::findOrFail($id);
        $test->delete();
        session()->flash('message', 'Tes keahlian berhasil dihapus.');
    }

    public function render(): View
    {
        $tests = SkillTest::query()
            ->with(['category', 'skill'])
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.skill-test-manager', [
            'tests' => $tests,
            'categories_list' => QuestionTitle::all(),
            'skills_list' => Skill::all(),
        ]);
    }
}
