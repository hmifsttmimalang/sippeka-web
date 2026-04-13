<?php

namespace App\Livewire\Admin;

use App\Models\QuestionTitle;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class QuestionTitleManager extends Component
{
    use WithPagination;

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
            $category = QuestionTitle::findOrFail($id);
            $this->name = $category->nama;
        } else {
            $this->name = '';
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

        if ($this->editingId) {
            $category = QuestionTitle::findOrFail($this->editingId);
            $category->update(['nama' => $this->name]);
            session()->flash('message', 'Mata soal berhasil diperbarui.');
        } else {
            QuestionTitle::create(['nama' => $this->name]);
            session()->flash('message', 'Mata soal berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function delete(int $id): void
    {
        $category = QuestionTitle::findOrFail($id);
        $category->delete();
        session()->flash('message', 'Mata soal berhasil dihapus.');
    }

    public function render(): View
    {
        $categories = QuestionTitle::query()
            ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.question-title-manager', [
            'categories' => $categories
        ])->layout('components.layouts.admin', ['header' => 'Manajemen Mata Soal']);
    }
}
