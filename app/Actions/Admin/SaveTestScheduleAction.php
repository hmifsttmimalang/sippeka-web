<?php

namespace App\Actions\Admin;

use App\Models\TestSchedule;

class SaveTestScheduleAction
{
    public function execute(array $data, ?int $id = null): TestSchedule
    {
        return TestSchedule::updateOrCreate(['id' => $id], [
            'major_id' => $data['major_id'],
            'test_date' => $data['test_date'],
            'test_time' => $data['test_time'],
        ]);
    }
}
