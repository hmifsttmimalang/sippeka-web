<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Web Developer',
                'Mobile Developer',
                'Data Scientist',
                'UI/UX Designer',
                'DevOps Engineer',
                'Network Engineer',
                'Graphic Designer',
                'Cybersecurity',
            ]),
        ];
    }
}
