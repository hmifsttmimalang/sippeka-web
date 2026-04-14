<?php

namespace Database\Seeders;

use App\Models\TestSchedule;
use Illuminate\Database\Seeder;

class TestScheduleSeeder extends Seeder
{
    public function run()
    {
        TestSchedule::factory()->count(6)->create(); // Create 6 test schedules
    }
}
