<?php

namespace App\Actions;

use App\Models\SkillTest;

class SaveSkillTestAction
{
    /**
     * Save or update a skill test.
     */
    public function execute(array $data, ?int $id = null): SkillTest
    {
        return SkillTest::updateOrCreate(
            ['id' => $id],
            [
                'name' => $data['name'],
                'question_title_id' => $data['question_title_id'],
                'skill_id' => $data['skill_id'],
                'duration_minutes' => $data['duration_minutes'],
                'shuffle_questions' => $data['shuffle_questions'],
                'shuffle_answers' => $data['shuffle_answers'],
            ]
        );
    }
}
