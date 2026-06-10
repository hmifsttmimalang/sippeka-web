<?php

namespace Database\Factories;

use App\Models\QuestionTitle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuestionTitle>
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
            'name' => $this->faker->randomElement([
                'Web Developer - Simulation',
                'Web Developer - Selection',
                'Mobile Developer - Simulation',
                'Mobile Developer - Selection',
                'Data Scientist - Selection',
                'Data Scientist - Simulation',
                'UI/UX Designer - Selection',
                'UI/UX Designer - Simulation',
                'DevOps Engineer - Simulation',
                'DevOps Engineer - Selection',
                'Network Engineer - Simulation',
                'Network Engineer - Selection',
            ]),
        ];
    }
}
