<?php

namespace App\Services\Admin;

use App\Models\Question;
use Illuminate\Pagination\LengthAwarePaginator;

class QuestionService
{
    public function getPaginatedQuestions(int $testId, string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return Question::query()
            ->where('skill_test_id', $testId)
            ->when($search, fn ($q) => $q->where('question_text', 'like', "%{$search}%"))
            ->latest()
            ->paginate($perPage);
    }

    public function deleteQuestion(int $id): void
    {
        Question::findOrFail($id)->delete();
    }
}
