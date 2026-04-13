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
            'nama' => $this->faker->randomElement([
                'Web Developer - Simulasi',
                'Web Developer - Seleksi',
                'Mobile Developer - Simulasi',
                'Mobile Developer - Seleksi',
                'Data Scientist - Seleksi',
                'Data Scientist - Simulasi',
                'UI/UX Designer - Seleksi',
                'UI/UX Designer - Simulasi',
                'DevOps Engineer - Simulasi',
                'DevOps Engineer - Seleksi',
                'Network Engineer - Simulasi',
                'Network Engineer - Seleksi'
            ]),
        ];
    }
}
