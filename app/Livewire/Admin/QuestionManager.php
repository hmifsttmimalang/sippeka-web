<?php

namespace App\Livewire\Admin;

use App\Actions\SaveQuestionAction;
use App\Models\Question;
use App\Models\SkillTest;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;

#[Layout('layouts.admin_app')]
class QuestionManager extends Component
{
    use WithAdminPagination;
    use WithFileUploads;

    public SkillTest $test;

    public string $search = '';

    // Form fields
    public string $question = '';

    public string $option_a = '';

    public string $option_b = '';

    public string $option_c = '';

    public string $option_d = '';

    public string $correct_answer = 'a';

    public ?int $editingId = null;

    public bool $showingModal = false;

    public $excelFile;

    public bool $showingImportModal = false;

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
            $question = Question::findOrFail($id);
            $this->question = $question->question;
            $this->option_a = $question->option_a;
            $this->option_b = $question->option_b;
            $this->option_c = $question->option_c;
            $this->option_d = $question->option_d;
            $this->correct_answer = $question->correct_answer;
        } else {
            $this->reset(['question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer']);
        }
    }

    public function closeModal(): void
    {
        $this->showingModal = false;
        $this->showingImportModal = false;
        $this->editingId = null;
    }

    public function openImportModal(): void
    {
        $this->resetErrorBag();
        $this->excelFile = null;
        $this->showingImportModal = true;
    }

    public function importFromExcel(): void
    {
        $this->validate([
            'excelFile' => 'required|mimes:xlsx,xls|max:5120',
        ]);

        try {
            $path = $this->excelFile->getRealPath();
            $spreadsheet = IOFactory::load($path);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();

            $count = 0;
            for ($row = 2; $row <= $highestRow; $row++) {
                $questionValue = $worksheet->getCell('A'.$row)->getValue();
                $optionAValue = $worksheet->getCell('B'.$row)->getValue();
                $optionBValue = $worksheet->getCell('C'.$row)->getValue();
                $optionCValue = $worksheet->getCell('D'.$row)->getValue();
                $optionDValue = $worksheet->getCell('E'.$row)->getValue();
                $correctAnswerValue = strtolower(trim($worksheet->getCell('F'.$row)->getValue()));

                if (empty($questionValue) || empty($optionAValue) || empty($correctAnswerValue)) {
                    continue;
                }

                Question::create([
                    'skill_test_id' => $this->test->id,
                    'question' => $questionValue,
                    'option_a' => $optionAValue,
                    'option_b' => $optionBValue,
                    'option_c' => $optionCValue,
                    'option_d' => $optionDValue,
                    'correct_answer' => in_array($correctAnswerValue, ['a', 'b', 'c', 'd']) ? $correctAnswerValue : 'a',
                ]);
                $count++;
            }

            session()->flash('message', "$count soal berhasil diimpor.");
            $this->closeModal();
        } catch (\Exception $e) {
            Log::error('Excel Import Error: '.$e->getMessage());
            $this->addError('excelFile', 'Gagal memproses file Excel. Pastikan format sesuai.');
        }
    }

    public function save(SaveQuestionAction $saveQuestionAction): void
    {
        $this->validate();

        $saveQuestionAction->execute([
            'skill_test_id' => $this->test->id,
            'question' => $this->question,
            'option_a' => $this->option_a,
            'option_b' => $this->option_b,
            'option_c' => $this->option_c,
            'option_d' => $this->option_d,
            'correct_answer' => $this->correct_answer,
        ], $this->editingId);

        session()->flash('message', $this->editingId ? 'Soal berhasil diperbarui.' : 'Soal berhasil ditambahkan.');

        $this->closeModal();
    }

    public function delete(int $id): void
    {
        $question = Question::findOrFail($id);
        $question->delete();
        session()->flash('message', 'Soal berhasil dihapus.');
    }

    public function render(): View
    {
        $questions = Question::query()
            ->where('skill_test_id', $this->test->id)
            ->when($this->search, fn ($q) => $q->where('question', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.question-manager', [
            'questions' => $questions,
            'title' => 'Manajemen Soal: '.$this->test->name,
        ]);
    }
}
