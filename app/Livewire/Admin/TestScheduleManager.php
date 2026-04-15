<?php

namespace App\Livewire\Admin;

use App\Actions\SaveTestScheduleAction;
use App\Models\Major;
use App\Models\TestSchedule;
use App\Services\Admin\ScheduleService;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Kelola Jadwal Tes')]
class TestScheduleManager extends Component
{
    use WithAdminPagination;

    public ?int $major_id = null;
    public string $test_date = '';
    public string $test_time = '';
    public ?int $editingId = null;
    public bool $isEditing = false;

    protected $rules = [
        'major_id' => 'required|exists:majors,id',
        'test_date' => 'required|date',
        'test_time' => 'required',
    ];

    public function save(SaveTestScheduleAction $action): void
    {
        $this->validate();

        // Ambil data form pake pull()
        $action->execute($this->only(['major_id', 'test_date', 'test_time']), $this->editingId);

        session()->flash('success', $this->editingId ? 'Jadwal diupdate.' : 'Jadwal ditambah.');
        $this->resetFields();
    }

    public function edit(int $id): void
    {
        $schedule = TestSchedule::findOrFail($id);
        $this->editingId = $id;
        // fill() otomatis ngisi major_id, test_date, dll selama namanya sama
        $this->fill($schedule->toArray());
        $this->isEditing = true;
    }

    public function delete(int $id, ScheduleService $service): void
    {
        $service->deleteSchedule($id);
        session()->flash('success', 'Jadwal dihapus.');
    }

    public function resetFields(): void
    {
        $this->reset(['major_id', 'test_date', 'test_time', 'editingId', 'isEditing']);
        $this->resetErrorBag();
    }

    public function render(ScheduleService $service): View
    {
        return view('livewire.admin.test-schedule-manager', [
            'testSchedules' => $service->getPaginatedSchedules(),
            'majors' => Major::all(),
        ]);
    }
}
