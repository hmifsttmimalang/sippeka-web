<?php

namespace App\Livewire\Student;

use App\Models\Announcement;
use App\Models\QuestionTitle;
use App\Models\Registration;
use App\Models\Skill;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user_app')]
#[Title('Student Dashboard')]
class Dashboard extends Component
{
    public User $user;

    public ?Registration $registration = null;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->registration = Registration::where('user_id', $this->user->id)->with('skill')->first();

        // If not registered, redirect to wizard
        if (!$this->registration) {
            redirect()->route('registration.form');
        }
    }

    public function render(): View
    {
        $now = Carbon::now('Asia/Jakarta');

        $skillId = $this->registration->skill_id;

        // Fetch sessions related to student's skill (Current, Upcoming, and Recently Finished)
        $allSessions = SkillTestSession::query()
            ->whereHas('test', function ($q) use ($skillId) {
                $q->where('skill_id', $skillId);
            })
            ->with(['test', 'test.category'])
            ->orderBy('start_time', 'asc')
            ->get();

        $processedSessions = $allSessions->map(function ($session) use ($now) {
            $attempt = TestAttempt::where('registration_id', $this->registration->id)
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

        $activeSessions = $processedSessions->filter(fn($s) => $s->student_status === 'active' || $s->student_status === 'finished');
        $upcomingSessions = $processedSessions->filter(fn($s) => $s->student_status === 'upcoming')->take(5);
        $lateSessions = $processedSessions->filter(fn($s) => $s->student_status === 'late')->take(3);

        // Announcement Logic
        $announcement = Announcement::latest()->first();
        $showAnnouncement = false;
        $formattedAnnouncementDate = null;

        if ($announcement) {
            $announcementDate = Carbon::parse($announcement->scheduled_at, 'Asia/Jakarta');
            $formattedAnnouncementDate = $announcementDate->translatedFormat('d F Y H:i');

            if ($now->greaterThanOrEqualTo($announcementDate)) {
                $showAnnouncement = true;
            }
        }

        // Selection Status Logic
        $skillScore = $this->registration->skill_test_score;
        $interviewScore = $this->registration->interview_score;
        $averageScore = null;
        $selectionStatus = 'Processing';

        if (!is_null($skillScore) && !is_null($interviewScore)) {
            $averageScore = ($skillScore + $interviewScore) / 2;
            $selectionStatus = ($averageScore >= 70) ? 'Passed' : 'Failed';
        }

        return view('livewire.student.dashboard', [
            'activeSessions' => $activeSessions,
            'upcomingSessions' => $upcomingSessions,
            'lateSessions' => $lateSessions,
            'showAnnouncement' => $showAnnouncement,
            'formattedAnnouncementDate' => $formattedAnnouncementDate,
            'selectionStatus' => $selectionStatus,
            'averageScore' => $averageScore,
            'skillScore' => $skillScore,
            'interviewScore' => $interviewScore,
            'registration' => $this->registration,
            'skills' => Skill::all(),
            'questionCategories' => QuestionTitle::all(),
        ]);
    }
}
