<?php

namespace App\Services\Student;

use App\Models\Announcement;
use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardService
{
    /**
     * Get test sessions grouped by student status (active, upcoming, late).
     *
     * @return array{activeSessions: Collection, upcomingSessions: Collection, lateSessions: Collection}
     */
    public function getProcessedSessions(Registration $registration): array
    {
        $now = Carbon::now('Asia/Jakarta');

        $allSessions = SkillTestSession::query()
            ->whereHas('test', fn ($q) => $q->where('skill_id', $registration->skill_id))
            ->with(['test', 'test.category'])
            ->orderBy('start_time', 'asc')
            ->get();

        $processedSessions = $allSessions->map(function ($session) use ($now, $registration) {
            $attempt = TestAttempt::where('registration_id', $registration->id)
                ->where('skill_test_session_id', $session->id)
                ->first();

            $startTime = Carbon::parse($session->start_time, 'Asia/Jakarta');
            $endTime = Carbon::parse($session->end_time, 'Asia/Jakarta');

            if ($attempt && $attempt->status === 'finished') {
                $session->student_status = 'finished';
            } elseif ($now->gt($endTime)) {
                $session->student_status = 'late';
            } elseif ($now->lt($startTime)) {
                $session->student_status = 'upcoming';
            } else {
                $session->student_status = 'active';
            }

            return $session;
        });

        return [
            'activeSessions' => $processedSessions->filter(fn ($s) => $s->student_status === 'active' || $s->student_status === 'finished'),
            'upcomingSessions' => $processedSessions->filter(fn ($s) => $s->student_status === 'upcoming')->take(5),
            'lateSessions' => $processedSessions->filter(fn ($s) => $s->student_status === 'late')->take(3),
        ];
    }

    /**
     * Get announcement display info.
     *
     * @return array{showAnnouncement: bool, formattedAnnouncementDate: string|null}
     */
    public function getAnnouncementInfo(): array
    {
        $announcement = Announcement::latest()->first();

        if (! $announcement) {
            return [
                'showAnnouncement' => false,
                'formattedAnnouncementDate' => null,
            ];
        }

        $now = Carbon::now('Asia/Jakarta');
        $announcementDate = Carbon::parse($announcement->scheduled_at, 'Asia/Jakarta');

        return [
            'showAnnouncement' => $now->greaterThanOrEqualTo($announcementDate),
            'formattedAnnouncementDate' => $announcementDate->translatedFormat('d F Y H:i'),
        ];
    }

    /**
     * Get selection status based on registration scores.
     *
     * @return array{selectionStatus: string, averageScore: float|null, skillScore: float|null, interviewScore: float|null}
     */
    public function getSelectionStatus(Registration $registration): array
    {
        $skillScore = $registration->skill_test_score;
        $interviewScore = $registration->interview_score;
        $averageScore = null;
        $selectionStatus = 'Processing';

        if (! is_null($skillScore) && ! is_null($interviewScore)) {
            $averageScore = ($skillScore + $interviewScore) / 2;
            $selectionStatus = ($averageScore >= 70) ? 'Passed' : 'Failed';
        }

        return [
            'selectionStatus' => $selectionStatus,
            'averageScore' => $averageScore,
            'skillScore' => $skillScore,
            'interviewScore' => $interviewScore,
        ];
    }
}
