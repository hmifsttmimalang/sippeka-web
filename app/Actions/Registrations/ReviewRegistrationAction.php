<?php

namespace App\Actions\Registrations;

use App\Models\Registration;

class ReviewRegistrationAction
{
    public function updateVerification(Registration $registration, string $status, ?string $notes = null): void
    {
        $registration->update([
            'verification_status' => $status,
            'verification_notes' => $notes,
        ]);
    }

    public function updateInterviewScore(Registration $registration, ?int $score): void
    {
        $registration->update(['interview_score' => $score]);
    }
}
