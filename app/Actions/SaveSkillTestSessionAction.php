<?php

namespace App\Actions;

use App\Models\SkillTestSession;

class SaveSkillTestSessionAction
{
    /**
     * Save or update a skill test session.
     */
    public function execute(array $data, ?int $id = null): SkillTestSession
    {
        return SkillTestSession::updateOrCreate(
            ['id' => $id],
            [
                'name' => $data['name'],
                'skill_test_id' => $data['skill_test_id'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'session_type' => $data['session_type'],
            ]
        );
    }
}
