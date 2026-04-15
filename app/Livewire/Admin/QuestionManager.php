<?php

namespace App\Livewire\Admin;

use App\Actions\Questions\ImportQuestionAction;
use App\Actions\Questions\SaveQuestionAction;
use App\Models\Question;
use App\Models\SkillTest;
use App\Services\Admin\QuestionService;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin_app')]
class QuestionManager extends Component
{
    use WithAdminPagination, WithFileUploads;

    public SkillTest $test;
    public string $search = '';
    public string $question = '', $option_a = '', $option_b = '', $option_c = '', $option_d = '';
    public string $correct_answer = 'a';
    public ?int $editingId = null;
    public bool $showingModal = false, $showingImportModal = false;
    public $excelFile;

    protected $rules = [
        'question' => 'required|min:10',
        'option_a' => 'required',
        'option_b' => 'required',
        'option_c' => 'required',
        'option_d' => 'required',
        'correct_answer' => 'required|in:a,b,c,d',
    ];

    public function mount(int $testId): void
    {
        $this->test = SkillTest::findOrFail($testId);
    }

    public function openModal(?int $id = null): void
    {
        $this->resetErrorBag();
        $this->editingId = $id;
        if ($id) {
            $q = Question::findOrFail($id);
            $this->fill($q->toArray());
        } else {
            $this->reset(['question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer']);
        }
        $this->showingModal = true;
    }

    public function importFromExcel(ImportQuestionAction $importAction): void
    {
        $this->validate(['excelFile' => 'required|mimes:xlsx,xls|max:5120']);

        try {
            $count = $importAction->execute($this->excelFile->getRealPath(), $this->test->id);
            session()->flash('message', "$count soal berhasil diimpor.");
            $this->closeModal();
        } catch (\Exception $e) {
            Log::error('Import Error: ' . $e->getMessage());
            $this->addError('excelFile', 'Format file tidak didukung atau file korup, coba import ulang!');
        }
    }

    public function save(SaveQuestionAction $action): void
    {
        $this->validate();
        $action->execute(array_merge($this->pull(), ['skill_test_id' => $this->test->id]), $this->editingId);
        session()->flash('message', 'Soal aman tersimpan.');
        $this->closeModal();
    }

    public function delete(int $id, QuestionService $service): void
    {
        $service->deleteQuestion($id);
        session()->flash('message', 'Soal dihapus.');
    }

    public function render(QuestionService $service): View
    {
        return view('livewire.admin.question-manager', [
            'questions' => $service->getPaginatedQuestions($this->test->id, $this->search),
            'title' => 'Manajemen Soal: ' . $this->test->name,
        ]);
    }

    public function closeModal(): void
    {
        $this->reset(['showingModal', 'showingImportModal', 'editingId', 'excelFile']);
    }
}
