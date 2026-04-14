<?php

namespace App\Actions;

use App\Models\Registration;
use App\Models\TestAttempt;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SubmitTestAttemptAction
{
    /**
     * Submit test attempt and calculate score.
     */
    public function handle(TestAttempt $attempt, Registration $registration, Collection $questions, array $userAnswers): array
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

        // Update Attempt
        $attempt->update([
            'status' => 'finished',
            'end_time' => Carbon::now('Asia/Jakarta'),
            'answers' => $userAnswers,
        ]);

        // Update Registration Score
        // Note: For 'Selection' type, we update skill_test_score. For 'Simulasi', we don't necessarily update it.
        // The component will decide based on session type.

        return [
            'score' => $scorePercentage,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctCount,
        ];
    }
}
