<?php

namespace App\Services\Admin;

use App\Models\TestSchedule;
use Illuminate\Pagination\LengthAwarePaginator;

class ScheduleService
{
    public function getPaginatedSchedules(int $perPage = 10): LengthAwarePaginator
    {
        return TestSchedule::with('major')
            ->latest()
            ->paginate($perPage);
    }

    public function deleteSchedule(int $id): void
    {
        TestSchedule::findOrFail($id)->delete();
    }
}
