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
        if ($id) {
            $skillTest = SkillTest::findOrFail($id);
            $skillTest->update([
                'name' => $data['name'],
                'question_title_id' => $data['question_title_id'],
                'skill_id' => $data['skill_id'],
                'shuffle_questions' => $data['shuffle_questions'],
                'shuffle_answers' => $data['shuffle_answers'],
                'duration_minutes' => $data['duration_minutes'],
            ]);
        } else {
            $skillTest = SkillTest::create([
                'name' => $data['name'],
                'question_title_id' => $data['question_title_id'],
                'skill_id' => $data['skill_id'],
                'shuffle_questions' => $data['shuffle_questions'],
                'shuffle_answers' => $data['shuffle_answers'],
                'duration_minutes' => $data['duration_minutes'],
            ]);
        }

        return $skillTest;
    }
}
