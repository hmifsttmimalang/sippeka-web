<?php

namespace App\Livewire\Admin;

use App\Models\Question;
use App\Models\SkillTest;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;

class QuestionManager extends Component
{
    use WithPagination;
    use WithFileUploads;

    public SkillTest $test;
    public string $search = '';

    // Form fields
    public string $soal = '';
    public string $pilihan_a = '';
    public string $pilihan_b = '';
    public string $pilihan_c = '';
    public string $pilihan_d = '';
    public string $jawaban_benar = 'a';

    public ?int $editingId = null;
    public bool $showingModal = false;
    public $excelFile;
    public bool $showingImportModal = false;

    protected $rules = [
        'soal' => 'required|min:10',
        'pilihan_a' => 'required',
        'pilihan_b' => 'required',
        'pilihan_c' => 'required',
        'pilihan_d' => 'required',
        'jawaban_benar' => 'required|in:a,b,c,d',
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
            $this->soal = $question->soal;
            $this->pilihan_a = $question->pilihan_a;
            $this->pilihan_b = $question->pilihan_b;
            $this->pilihan_c = $question->pilihan_c;
            $this->pilihan_d = $question->pilihan_d;
            $this->jawaban_benar = $question->jawaban_benar;
        } else {
            $this->reset(['soal', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'jawaban_benar']);
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
                $soal = $worksheet->getCell('A' . $row)->getValue();
                $pilihanA = $worksheet->getCell('B' . $row)->getValue();
                $pilihanB = $worksheet->getCell('C' . $row)->getValue();
                $pilihanC = $worksheet->getCell('D' . $row)->getValue();
                $pilihanD = $worksheet->getCell('E' . $row)->getValue();
                $jawabanBenar = strtolower(trim($worksheet->getCell('F' . $row)->getValue()));

                if (empty($soal) || empty($pilihanA) || empty($jawabanBenar)) {
                    continue;
                }

                Question::create([
                    'skill_test_id' => $this->test->id,
                    'soal' => $soal,
                    'pilihan_a' => $pilihanA,
                    'pilihan_b' => $pilihanB,
                    'pilihan_c' => $pilihanC,
                    'pilihan_d' => $pilihanD,
                    'jawaban_benar' => in_array($jawabanBenar, ['a', 'b', 'c', 'd']) ? $jawabanBenar : 'a',
                ]);
                $count++;
            }

            session()->flash('message', "$count soal berhasil diimpor.");
            $this->closeModal();
        } catch (\Exception $e) {
            Log::error('Excel Import Error: ' . $e->getMessage());
            $this->addError('excelFile', 'Gagal memproses file Excel. Pastikan format sesuai.');
        }
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'skill_test_id' => $this->test->id,
            'soal' => $this->soal,
            'pilihan_a' => $this->pilihan_a,
            'pilihan_b' => $this->pilihan_b,
            'pilihan_c' => $this->pilihan_c,
            'pilihan_d' => $this->pilihan_d,
            'jawaban_benar' => $this->jawaban_benar,
        ];

        if ($this->editingId) {
            $question = Question::findOrFail($this->editingId);
            $question->update($data);
            session()->flash('message', 'Soal berhasil diperbarui.');
        } else {
            Question::create($data);
            session()->flash('message', 'Soal berhasil ditambahkan.');
        }

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
            ->when($this->search, fn($q) => $q->where('soal', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.question-manager', [
            'questions' => $questions
        ])->layout('layouts.admin_app', ['title' => 'Manajemen Soal: ' . $this->test->nama_tes]);
    }
}
