<?php

namespace App\Actions\Skills;

use App\Models\Skill;

class SaveSkillAction
{
    public function execute(string $name, ?int $id = null): Skill
    {
        return Skill::updateOrCreate(
            ['id' => $id],
            ['name' => $name]
        );
    }
}
