<?php

namespace App\Actions\Student;

use App\Models\TestAttempt;
use App\Services\Student\TestAttemptService;
use Illuminate\Support\Collection;

class SubmitTestAttemptAction
{
    public function __construct(private TestAttemptService $testAttemptService) {}

    public function execute(TestAttempt $attempt, Collection $questions, array $userAnswers): array
    {
        return $this->testAttemptService->submit($attempt, $questions, $userAnswers);
    }
}
