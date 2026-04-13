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
        
        // Fetch active sessions relative to the student's training program
        $activeSessions = SkillTestSession::query()
            ->where('waktu_mulai', '<=', $now)
            ->where('waktu_selesai', '>=', $now)
            ->whereHas('test', function($q) {
                $q->where('keahlian_id', $this->registration->keahlian);
            })
            ->with(['test', 'test.category'])
            ->get();

        return view('livewire.student.dashboard', [
            'activeSessions' => $activeSessions
        ])->layout('layouts.user_app', ['title' => 'Student Dashboard']);
    }
}
