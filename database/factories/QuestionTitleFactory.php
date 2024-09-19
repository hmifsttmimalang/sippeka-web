<?php

namespace Database\Factories;

use App\Models\QuestionTitle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionTitle>
 */
class QuestionTitleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = QuestionTitle::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->sentence(3), // Generates a random title with 3 words
        ];
    }
}
