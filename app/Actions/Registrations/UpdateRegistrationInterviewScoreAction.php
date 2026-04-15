<?php

namespace App\Actions\Registrations;

use App\Models\Registration;

class UpdateRegistrationInterviewScoreAction
{
    /**
     * Update interview score.
     */
    public function execute(Registration $registration, ?float $score): void
    {
        $registration->update([
            'interview_score' => $score,
        ]);
    }
}
