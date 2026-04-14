<?php

namespace App\Actions;

use App\Models\Registration;

class ReviewRegistrationAction
{
    /**
     * Update verification status.
     */
    public function updateVerification(Registration $registration, string $status, ?string $notes = null): void
    {
        $registration->update([
            'verification_status' => $status,
            'verification_notes' => $notes,
        ]);
    }

    /**
     * Update interview score.
     */
    public function updateInterviewScore(Registration $registration, ?float $score): void
    {
        $registration->update([
            'interview_score' => $score,
        ]);
    }
}
