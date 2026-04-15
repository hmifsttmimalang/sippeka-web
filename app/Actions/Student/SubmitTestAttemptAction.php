<?php

namespace App\Actions\Student;

use App\Models\Registration;
use App\Models\TestAttempt;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SubmitTestAttemptAction
{
    public function execute(TestAttempt $attempt, Registration $registration, Collection $questions, array $userAnswers): array
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
