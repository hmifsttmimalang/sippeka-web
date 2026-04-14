<?php

namespace App\Actions;

use App\Models\Skill;

class SaveSkillAction
{
    /**
     * Save or update a skill.
     */
    public function execute(string $name, ?int $id = null): Skill
    {
        if ($id) {
            $skill = Skill::findOrFail($id);
            $skill->update(['name' => $name]);
        } else {
            $skill = Skill::create(['name' => $name]);
        }

        return $skill;
    }
}
