<?php

namespace App\Livewire\Student;

use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use App\Models\User;
use App\Models\Skill;
use App\Models\QuestionTitle;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

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
            redirect()->route('pendaftaran.form');
        }
    }

    public function render(): View
    {
        $now = Carbon::now('Asia/Jakarta');
        $nowString = $now->format('Y-m-d\TH:i'); // SQLite uses string comparison, must match DB format

        // Fix relationship conflict by using attribute directly
        $keahlianId = $this->registration->getAttribute('keahlian');

        // Fetch sessions related to student's skill (Current, Upcoming, and Recently Finished)
        $allSessions = SkillTestSession::query()
            ->whereHas('test', function ($q) use ($keahlianId) {
                $q->where('keahlian', $keahlianId);
            })
            ->with(['test', 'test.category'])
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        $processedSessions = $allSessions->map(function ($session) use ($now, $nowString) {
            $attempt = TestAttempt::where('registration_id', $this->registration->id)
                ->where('skill_test_session_id', $session->id)
                ->first();

            $startTime = Carbon::parse($session->waktu_mulai, 'Asia/Jakarta');
            $endTime = Carbon::parse($session->waktu_selesai, 'Asia/Jakarta');

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

        // Announcement (Pengumuman) Logic from Legacy
        $pengumuman = \App\Models\Pengumuman::latest()->first();
        $showAnnouncement = false;
        $formattedAnnouncementDate = null;

        if ($pengumuman) {
            $pengumumanDate = Carbon::parse($pengumuman->tanggal_waktu, 'Asia/Jakarta');
            $formattedAnnouncementDate = $pengumumanDate->translatedFormat('d F Y H:i');

            if ($now->greaterThanOrEqualTo($pengumumanDate)) {
                $showAnnouncement = true;
            }
        }

        // Status Logic from Legacy
        $nilaiKeahlian = $this->registration->nilai_keahlian;
        $nilaiWawancara = $this->registration->nilai_wawancara;
        $rataRata = null;
        $statusSeleksi = 'Sedang Diproses';

        if (!is_null($nilaiKeahlian) && !is_null($nilaiWawancara)) {
            $rataRata = ($nilaiKeahlian + $nilaiWawancara) / 2;
            $statusSeleksi = ($rataRata >= 70) ? 'Lulus' : 'Tidak Lulus';
        }

        return view('livewire.student.dashboard', [
            'activeSessions' => $activeSessions,
            'upcomingSessions' => $upcomingSessions,
            'lateSessions' => $lateSessions,
            'showAnnouncement' => $showAnnouncement,
            'formattedAnnouncementDate' => $formattedAnnouncementDate,
            'statusSeleksi' => $statusSeleksi,
            'rataRata' => $rataRata,
            'nilaiKeahlian' => $nilaiKeahlian,
            'nilaiWawancara' => $nilaiWawancara,
            'registration' => $this->registration,
            'skills' => Skill::all(),
            'questionCategories' => QuestionTitle::all(),
        ]);
    }
}
