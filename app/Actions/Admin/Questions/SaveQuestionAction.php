<?php

namespace App\Actions\Admin\Questions;

use App\Models\Question;

class SaveQuestionAction
{
    public function execute(array $data, ?int $id = null): Question
    {
        return Question::updateOrCreate(['id' => $id], $data);
    }
}
