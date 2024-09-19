<?php

namespace Database\Factories;

use App\Models\QuestionTitle;
use App\Models\Skill;
use App\Models\SkillTest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SkillTest>
 */
class SkillTestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SkillTest::class;

    public function definition()
    {
        return [
            'nama_tes' => $this->faker->word(),  // No need for unique here unless required
            'mata_soal' => QuestionTitle::inRandomOrder()->first()->id,  // Random QuestionTitle
            'keahlian' => Skill::inRandomOrder()->first()->id,           // Random Skill
            'acak_soal' => $this->faker->randomElement(['y', 't']),
            'acak_jawaban' => $this->faker->randomElement(['y', 't']),
            'durasi_menit' => 90,  // Fixed duration
        ];
    }
}
