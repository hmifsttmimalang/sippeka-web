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
        // Dapatkan keahlian secara acak
        $keahlian = $this->faker->randomElement([
            'Web Developer',
            'Mobile Developer',
            'Data Scientist',
            'UI/UX Designer',
            'DevOps Engineer',
            'Network Engineer'
        ]);

        return [
            'nama' => $keahlian, // Samakan nama mata soal dengan keahlian
        ];
    }
}
