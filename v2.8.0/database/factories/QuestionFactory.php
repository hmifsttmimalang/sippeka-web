<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\SkillTest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Question::class;

    public function definition()
    {
        return [
            'skill_test_id' => SkillTest::factory(),  // Create or associate with a SkillTest
            'soal' => $this->faker->sentence(10),  // Generate a random question
            'pilihan_a' => $this->faker->word(),
            'pilihan_b' => $this->faker->word(),
            'pilihan_c' => $this->faker->word(),
            'pilihan_d' => $this->faker->word(),
            'jawaban_benar' => $this->faker->randomElement(['A', 'B', 'C', 'D']),  // Random correct answer
        ];
    }
}
