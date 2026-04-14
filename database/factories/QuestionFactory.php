<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\QuestionTitle;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'question_title_id' => QuestionTitle::factory(),
            'question_text' => $this->faker->sentence(10),
            'option_a' => $this->faker->word(),
            'option_b' => $this->faker->word(),
            'option_c' => $this->faker->word(),
            'option_d' => $this->faker->word(),
            'correct_answer' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
        ];
    }
}
