<?php

namespace App\Livewire\Admin;

use App\Actions\SaveMajorAction;
use App\Models\Major;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Kelola Jurusan')]
class MajorManager extends Component
{
    use WithAdminPagination;

    public string $name = '';

    public ?int $quota = null;

    public string $status = 'Open';

    public ?int $major_id = null;

    public bool $isEditing = false;

    public string $search = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'quota' => 'required|integer|min:0',
        'status' => 'required|in:Open,Closed',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $majors = Major::where('name', 'like', '%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.admin.major-manager', [
            'majors' => $majors,
        ]);
    }

    public function resetFields(): void
    {
        $this->reset(['name', 'quota', 'status', 'major_id', 'isEditing']);
        $this->status = 'Open';
        $this->resetErrorBag();
    }

    public function save(SaveMajorAction $saveMajorAction): void
    {
        $this->validate();

        $saveMajorAction->execute([
            'name' => $this->name,
            'quota' => $this->quota,
            'status' => $this->status,
        ], $this->major_id);

        session()->flash('success', $this->major_id ? 'Jurusan berhasil diperbarui.' : 'Jurusan berhasil ditambahkan.');
        $this->resetFields();
    }

    public function edit(int $id): void
    {
        $major = Major::findOrFail($id);
        $this->major_id = $id;
        $this->name = $major->name;
        $this->quota = (int) $major->quota;
        $this->status = $major->status;
        $this->isEditing = true;
    }

    public function delete(int $id): void
    {
        $major = Major::findOrFail($id);
        $major->delete();
        session()->flash('success', 'Jurusan berhasil dihapus.');
    }
}
