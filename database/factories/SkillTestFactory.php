<?php

namespace Database\Factories;

use App\Models\QuestionTitle;
use App\Models\Skill;
use App\Models\SkillTest;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillTestFactory extends Factory
{
    protected $model = SkillTest::class;

    public function definition()
    {
        $questionTitle = QuestionTitle::inRandomOrder()->first() ?? QuestionTitle::factory()->create();
        $skill = Skill::inRandomOrder()->first() ?? Skill::factory()->create();

        return [
            'name' => $this->faker->sentence(3),
            'question_title_id' => $questionTitle->id,
            'skill_id' => $skill->id,
            'shuffle_questions' => $this->faker->randomElement(['y', 't']),
            'shuffle_answers' => $this->faker->randomElement(['y', 't']),
            'duration_minutes' => $this->faker->numberBetween(30, 120),
        ];
    }
}
