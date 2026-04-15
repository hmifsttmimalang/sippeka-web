<?php

namespace App\Services\Student;

use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TestSessionService
{
    /**
     * Validate that a session is eligible to be taken.
     *
     * @return string|null Error message, or null if valid.
     */
    public function validateSession(SkillTestSession $session, Registration $registration, string $expectedType): ?string
    {
        if ($session->session_type !== $expectedType) {
            return "Sesi ini bukan ujian {$expectedType}.";
        }

        $now = Carbon::now('Asia/Jakarta');
        $startAt = Carbon::parse($session->start_time, 'Asia/Jakarta');
        $endAt = Carbon::parse($session->end_time, 'Asia/Jakarta');

        if ($now->lt($startAt)) {
            return 'Sesi ini belum dimulai. Silakan kembali pada jam '.$startAt->format('H:i').'.';
        }

        if ($now->gt($endAt)) {
            return 'Mohon maaf, waktu pengerjaan untuk sesi ini telah berakhir (Terlambat).';
        }

        $finishedAttempt = TestAttempt::where('registration_id', $registration->id)
            ->where('skill_test_session_id', $session->id)
            ->where('status', 'finished')
            ->exists();

        if ($finishedAttempt) {
            return 'Anda sudah menyelesaikan ujian pada sesi ini.';
        }

        return null;
    }

    /**
     * Initialize or resume a test attempt.
     */
    public function initializeAttempt(Registration $registration, SkillTestSession $session): TestAttempt
    {
        return TestAttempt::firstOrCreate([
            'registration_id' => $registration->id,
            'skill_test_session_id' => $session->id,
            'status' => 'in_progress',
        ], [
            'start_time' => Carbon::now('Asia/Jakarta'),
            'answers' => [],
        ]);
    }

    /**
     * Load and optionally shuffle questions with their options.
     *
     * @return array{questions: Collection, shuffledOptions: array<int, array<string, string>>}
     */
    public function loadQuestions(SkillTestSession $session): array
    {
        $test = $session->test;
        $allQuestions = $test->questions;

        if ($test->shuffle_questions === 'y') {
            $allQuestions = $allQuestions->shuffle();
        }

        $shuffledOptions = [];

        $questions = $allQuestions->map(function ($q) use ($test, &$shuffledOptions) {
            $options = [
                'a' => $q->option_a,
                'b' => $q->option_b,
                'c' => $q->option_c,
                'd' => $q->option_d,
            ];

            if ($test->shuffle_answers === 'y') {
                $keys = array_keys($options);
                shuffle($keys);
                $shuffled = [];
                foreach ($keys as $key) {
                    $shuffled[$key] = $options[$key];
                }
                $shuffledOptions[$q->id] = $shuffled;
            } else {
                $shuffledOptions[$q->id] = $options;
            }

            return $q;
        });

        return [
            'questions' => $questions,
            'shuffledOptions' => $shuffledOptions,
        ];
    }

    /**
     * Calculate remaining seconds until session ends.
     */
    public function calculateRemainingSeconds(SkillTestSession $session): int
    {
        $now = Carbon::now('Asia/Jakarta');
        $end = Carbon::parse($session->end_time, 'Asia/Jakarta');

        return (int) $now->diffInSeconds($end, false);
    }

    /**
     * Persist current answers to the database.
     */
    public function saveAnswer(int $attemptId, array $userAnswers): void
    {
        TestAttempt::where('id', $attemptId)->update([
            'answers' => $userAnswers,
        ]);
    }
}
