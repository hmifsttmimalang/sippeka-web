<?php

namespace App\Actions;

use App\Models\QuestionTitle;

class SaveSubjectAction
{
    /**
     * Create or update a subject (question title).
     */
    public function execute(string $name, ?int $id = null): QuestionTitle
    {
        if ($id) {
            $subject = QuestionTitle::findOrFail($id);
            $subject->update(['name' => $name]);
        } else {
            $subject = QuestionTitle::create(['name' => $name]);
        }

        return $subject;
    }
}
