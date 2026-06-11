<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestAttemptFactory extends Factory
{
    protected $model = TestAttempt::class;

    public function definition()
    {
        $startTime = $this->faker->dateTimeBetween('-1 month', 'now');
        $endTime = (clone $startTime)->modify('+1 hour');

        return [
            'registration_id' => Registration::factory(),
            'skill_test_session_id' => SkillTestSession::factory(),
            'score' => $this->faker->numberBetween(0, 100),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'answers' => null,
        ];
    }
}
