<?php

namespace App\Services\Student;

use App\Models\TestAttempt;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TestAttemptService
{
    /**
     * @return array{score: float|int, total_questions: int, correct_answers: int}
     */
    public function submit(TestAttempt $attempt, Collection $questions, array $userAnswers): array
    {
        $correctCount = 0;
        $totalQuestions = $questions->count();

        foreach ($questions as $question) {
            $userAnswer = $userAnswers[$question->id] ?? null;
            if ($userAnswer === $question->correct_answer) {
                $correctCount++;
            }
        }

        $scorePercentage = $totalQuestions > 0 ? ($correctCount / $totalQuestions) * 100 : 0;

        $attempt->update([
            'status' => 'finished',
            'end_time' => Carbon::now('Asia/Jakarta'),
            'answers' => $userAnswers,
        ]);

        return [
            'score' => $scorePercentage,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctCount,
        ];
    }
}
