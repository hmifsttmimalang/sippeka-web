<?php

namespace App\Livewire\Admin;

use App\Actions\SaveTestScheduleAction;
use App\Models\Major;
use App\Models\TestSchedule;
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

    public function render(): View
    {
        $testSchedules = TestSchedule::with('major')->paginate(10);
        $majors = Major::all();

        return view('livewire.admin.test-schedule-manager', [
            'testSchedules' => $testSchedules,
            'majors' => $majors,
        ]);
    }

    public function resetFields(): void
    {
        $this->reset(['major_id', 'test_date', 'test_time', 'editingId', 'isEditing']);
        $this->resetErrorBag();
    }

    public function save(SaveTestScheduleAction $saveTestScheduleAction): void
    {
        $this->validate();

        $saveTestScheduleAction->execute([
            'major_id' => $this->major_id,
            'test_date' => $this->test_date,
            'test_time' => $this->test_time,
        ], $this->editingId);

        session()->flash('success', $this->editingId ? 'Jadwal tes berhasil diperbarui.' : 'Jadwal tes berhasil ditambahkan.');
        $this->resetFields();
    }

    public function edit(int $id): void
    {
        $schedule = TestSchedule::findOrFail($id);
        $this->editingId = $id;
        $this->major_id = $schedule->major_id;
        $this->test_date = $schedule->test_date;
        $this->test_time = $schedule->test_time;
        $this->isEditing = true;
    }

    public function delete(int $id): void
    {
        $schedule = TestSchedule::findOrFail($id);
        $schedule->delete();
        session()->flash('success', 'Jadwal tes berhasil dihapus.');
    }
}
