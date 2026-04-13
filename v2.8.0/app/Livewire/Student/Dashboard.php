<?php

namespace App\Livewire\Student;

use App\Models\Registration;
use App\Models\SkillTestSession;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class Dashboard extends Component
{
    public User $user;
    public ?Registration $registration = null;

    public function mount(): void
    {
        $this->user = auth()->user();
        $this->registration = Registration::where('user_id', $this->user->id)->with('keahlian_rel')->first();
        
        // If not registered, redirect to wizard
        if (!$this->registration) {
            redirect()->route('pendaftaran.form');
        }
    }

    public function render(): View
    {
        $now = Carbon::now('Asia/Jakarta');
        
        // Fix relationship conflict by using attribute directly
        $keahlianId = $this->registration->getAttribute('keahlian');

        // Fetch active sessions relative to the student's training program
        $activeSessions = SkillTestSession::query()
            ->where('waktu_mulai', '<=', $now)
            ->where('waktu_selesai', '>=', $now)
            ->whereHas('test', function($q) use ($keahlianId) {
                $q->where('keahlian', $keahlianId);
            })
            ->with(['test', 'test.category'])
            ->get();

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
            'showAnnouncement' => $showAnnouncement,
            'formattedAnnouncementDate' => $formattedAnnouncementDate,
            'statusSeleksi' => $statusSeleksi,
            'rataRata' => $rataRata,
            'nilaiKeahlian' => $nilaiKeahlian,
            'nilaiWawancara' => $nilaiWawancara,
        ])->layout('layouts.user_app', ['title' => 'Student Dashboard']);
    }
}
