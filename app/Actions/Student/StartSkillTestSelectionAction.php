<?php

namespace App\Actions\Student;

use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use App\Models\User;
use Carbon\Carbon;

class StartSkillTestSelectionAction
{
    /**
     * @return array{status: string, message?: string}
     */
    public function execute(User $user): array
    {
        $registration = Registration::where('user_id', $user->id)->first();

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
