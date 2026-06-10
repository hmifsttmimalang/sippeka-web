<?php

namespace App\Actions\Registrations;

use App\Models\Registration;

class UpdateRegistrationVerificationAction
{
    /**
     * Update verification status.
     */
    public function execute(Registration $registration, string $status, ?string $notes = null): void
    {
        $registration->update([
            'verification_status' => $status,
            'verification_notes' => $notes,
        ]);
    }
}
