<?php

namespace Database\Factories;

use App\Models\SkillTest;
use App\Models\SkillTestSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillTestSessionFactory extends Factory
{
    protected $model = SkillTestSession::class;

    public function definition()
    {
        $startTime = $this->faker->dateTimeBetween('now', '+1 week');
        $endTime = (clone $startTime)->modify('+2 hours');

        $skillTest = SkillTest::inRandomOrder()->first() ?? SkillTest::factory()->create();
        $sessionType = $this->faker->randomElement(['Selection', 'Simulation']);

        return [
            'skill_test_id' => $skillTest->id,
            'name' => $sessionType.' - '.$skillTest->name,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'session_type' => $sessionType,
        ];
    }
}
