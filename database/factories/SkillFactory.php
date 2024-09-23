<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Skill::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->unique()->randomElement([
                'Web Developer',
                'Mobile Developer',
                'Data Scientist',
                'UI/UX Designer',
                'DevOps Engineer',
                'Network Engineer'
            ]),
        ];
    }
}
