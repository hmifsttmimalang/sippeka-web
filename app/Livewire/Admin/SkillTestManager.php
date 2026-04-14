<?php

namespace App\Livewire\Admin;

use App\Models\Skill;
use App\Models\SkillTest;
use App\Models\QuestionTitle;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class SkillTestManager extends Component
{
    use WithPagination;

    public string $search = '';
    
    // Form fields
    public string $nama_tes = '';
    public ?int $mata_soal = null;
    public ?int $keahlian = null;
    public int $durasi_menit = 60;
    public string $acak_soal = 'y';
    public string $acak_jawaban = 'y';

    public ?int $editingId = null;
    public bool $showingModal = false;

    protected $rules = [
        'nama_tes' => 'required|min:3|max:255',
        'mata_soal' => 'required|exists:question_titles,id',
        'keahlian' => 'required|exists:skills,id',
        'durasi_menit' => 'required|integer|min:1',
        'acak_soal' => 'required|in:y,t',
        'acak_jawaban' => 'required|in:y,t',
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
            $this->nama_tes = $test->nama_tes;
            $this->mata_soal = $test->mata_soal;
            $this->keahlian = $test->keahlian;
            $this->durasi_menit = $test->durasi_menit;
            $this->acak_soal = $test->acak_soal;
            $this->acak_jawaban = $test->acak_jawaban;
        } else {
            $this->reset(['nama_tes', 'mata_soal', 'keahlian', 'durasi_menit', 'acak_soal', 'acak_jawaban']);
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
            'nama_tes' => $this->nama_tes,
            'mata_soal' => $this->mata_soal,
            'keahlian' => $this->keahlian,
            'durasi_menit' => $this->durasi_menit,
            'acak_soal' => $this->acak_soal,
            'acak_jawaban' => $this->acak_jawaban,
        ];

        if ($this->editingId) {
            $test = SkillTest::findOrFail($this->editingId);
            $test->update($data);
            session()->flash('message', 'Tes keahlian berhasil diperbarui.');
        } else {
            SkillTest::create($data);
            session()->flash('message', 'Tes keahlian berhasil ditambahkan.');
        }

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
            ->when($this->search, fn($q) => $q->where('nama_tes', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.skill-test-manager', [
            'tests' => $tests,
            'categories_list' => QuestionTitle::all(),
            'skills_list' => Skill::all(),
        ])->layout('layouts.admin_app', ['title' => 'Kelola Tes Keahlian']);
    }
}
