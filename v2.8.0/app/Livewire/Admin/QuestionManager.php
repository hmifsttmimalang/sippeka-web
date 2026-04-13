<?php

namespace App\Livewire\Admin;

use App\Models\Question;
use App\Models\SkillTest;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class QuestionManager extends Component
{
    use WithPagination;

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
        $this->editingId = null;
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
        ])->layout('components.layouts.admin', ['header' => 'Manajemen Soal: ' . $this->test->nama_tes]);
    }
}
