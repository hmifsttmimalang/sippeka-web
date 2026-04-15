<?php

namespace App\Actions\Admin\Subjects;

use App\Models\QuestionTitle;

class SaveSubjectAction
{
    public function execute(string $name, ?int $id = null): QuestionTitle
    {
        return QuestionTitle::updateOrCreate(
            ['id' => $id],
            ['name' => $name]
        );
    }
}
