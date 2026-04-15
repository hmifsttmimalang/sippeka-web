<?php

namespace App\Livewire\Admin;

use App\Actions\SaveMajorAction;
use App\Models\Major;
use App\Services\Admin\MajorService;
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

    public function save(SaveMajorAction $action): void
    {
        $this->validate();

        // Pake pull() biar datanya langsung diambil dan direset sekaligus
        $action->execute($this->only(['name', 'quota', 'status']), $this->major_id);

        session()->flash('success', $this->major_id ? 'Jurusan diperbarui.' : 'Jurusan ditambah.');
        $this->resetFields();
    }

    public function edit(int $id): void
    {
        $major = Major::findOrFail($id);
        $this->major_id = $id;
        $this->fill($major->toArray());
        $this->isEditing = true;
    }

    public function delete(int $id, MajorService $service): void
    {
        try {
            $service->deleteMajor($id);
            session()->flash('success', 'Jurusan dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function resetFields(): void
    {
        $this->reset(['name', 'quota', 'status', 'major_id', 'isEditing']);
        $this->status = 'Open';
        $this->resetErrorBag();
    }

    public function render(MajorService $service): View
    {
        return view('livewire.admin.major-manager', [
            'majors' => $service->getPaginatedMajors($this->search),
        ]);
    }
}
