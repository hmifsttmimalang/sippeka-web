<?php

namespace App\Actions;

use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use App\Models\User;
use Carbon\Carbon;

class StartSkillTestSelectionAction
{
    /**
     * Start a skill test selection session for a user.
     *
     * @return array{status: string, message?: string}
     */
    public function execute(User $user): array
    {
        // Temukan pendaftaran (registration) user
        $registration = Registration::where('user_id', $user->id)->first();

        // Find active skill test session
        $skillTestSession = SkillTestSession::where('session_type', 'Selection')
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->first();

        if (! $skillTestSession) {
            return [
                'status' => 'error',
                'message' => 'Tidak ada sesi yang aktif saat ini',
            ];
        }

        // Check or create test attempt
        TestAttempt::firstOrCreate(
            [
                'registration_id' => $registration->id,
                'skill_test_session_id' => $skillTestSession->id,
            ],
            [
                'status' => 'in_progress',
                'start_time' => Carbon::now(),
            ]
        );

        return ['status' => 'success'];
    }
}
