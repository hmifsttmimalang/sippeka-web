<?php

namespace Database\Factories;

use App\Models\SkillTest;
use App\Models\SkillTestSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SkillTestSession>
 */
class SkillTestSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SkillTestSession::class;

    public function definition()
    {
        $start_time = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $end_time = (clone $start_time)->modify('+2 hours'); // Add 2 hours to start time

        return [
            'nama_sesi' => $this->faker->words(3, true),  // Generates a random session name
            'skill_test_id' => SkillTest::factory(),      // Create or associate with a SkillTest
            'waktu_mulai' => $start_time,
            'waktu_selesai' => $end_time,
            'jenis_sesi' => $this->faker->randomElement(['Seleksi', 'Simulasi']),
        ];
    }
}
