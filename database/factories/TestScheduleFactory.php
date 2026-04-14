<?php

namespace Database\Factories;

use App\Models\Major;
use App\Models\TestSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestScheduleFactory extends Factory
{
    protected $model = TestSchedule::class;

    public function definition()
    {
        return [
            'major_id' => Major::factory(),
            'test_date' => $this->faker->date(),
            'test_time' => $this->faker->time(),
        ];
    }
}
