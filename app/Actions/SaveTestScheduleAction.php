<?php

namespace App\Actions;

use App\Models\TestSchedule;

class SaveTestScheduleAction
{
    /**
     * Create or update a test schedule.
     */
    public function execute(array $data, ?int $id = null): TestSchedule
    {
        if ($id) {
            $schedule = TestSchedule::findOrFail($id);
            $schedule->update([
                'major_id' => $data['major_id'],
                'test_date' => $data['test_date'],
                'test_time' => $data['test_time'],
            ]);
        } else {
            $schedule = TestSchedule::create([
                'major_id' => $data['major_id'],
                'test_date' => $data['test_date'],
                'test_time' => $data['test_time'],
            ]);
        }

        return $schedule;
    }
}
