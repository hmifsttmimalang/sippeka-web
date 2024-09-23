<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TestAttempt>
 */
class TestAttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TestAttempt::class;

    public function definition()
    {
        $start_time = $this->faker->dateTimeBetween('-1 week', 'now');
        $end_time = $this->faker->dateTimeBetween($start_time, '+1 week');
        $has_end_time = $this->faker->boolean(); // Randomly decide if there will be an end time

        return [
            'registration_id' => Registration::inRandomOrder()->first()->id,  // Random Registration
            'skill_test_session_id' => SkillTestSession::inRandomOrder()->first()->id, // Random SkillTestSession
            'status' => $has_end_time ? 'finished' : 'in_progress',  // Set status based on end time
            'waktu_mulai' => $this->faker->boolean() ? $start_time : null, // Randomly assign a start time or leave it null
            'waktu_selesai' => $has_end_time ? $end_time : null,   // Assign end time based on condition
        ];
    }
}
