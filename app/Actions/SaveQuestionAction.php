<?php

namespace App\Actions;

use App\Models\Question;

class SaveQuestionAction
{
    /**
     * Execute the action to save or update a question.
     *
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data, ?int $id = null): Question
    {
        if ($id) {
            $question = Question::findOrFail($id);
            $question->update($data);

            return $question;
        }

        return Question::create($data);
    }
}
