<?php

namespace App\Services\Student;

use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use App\Models\User;
use Carbon\Carbon;

class SelectionSessionService
{
    /**
     * @return array{status: string, message?: string}
     */
    public function start(User $user): array
    {
        $registration = Registration::where('user_id', $user->id)->first();
        if (! $registration) {
            return [
                'status' => 'error',
                'message' => 'Data pendaftaran tidak ditemukan.',
            ];
        }

        $session = SkillTestSession::where('session_type', 'Selection')
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->first();

        if (! $session) {
            return [
                'status' => 'error',
                'message' => 'Tidak ada sesi yang aktif saat ini',
            ];
        }

        TestAttempt::firstOrCreate(
            [
                'registration_id' => $registration->id,
                'skill_test_session_id' => $session->id,
            ],
            [
                'status' => 'in_progress',
                'start_time' => Carbon::now(),
            ]
        );

        return ['status' => 'success'];
    }
}
