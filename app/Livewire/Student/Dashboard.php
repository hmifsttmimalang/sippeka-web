<?php

namespace App\Livewire\Student;

use App\Models\QuestionTitle;
use App\Models\Registration;
use App\Models\Skill;
use App\Models\User;
use App\Services\Student\DashboardService;
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
        if (! $this->registration) {
            redirect()->route('registration.form');
        }
    }

    public function render(DashboardService $service): View
    {
        $sessions = $service->getProcessedSessions($this->registration);
        $announcement = $service->getAnnouncementInfo();
        $selection = $service->getSelectionStatus($this->registration);

        return view('livewire.student.dashboard', [
            ...$sessions,
            ...$announcement,
            ...$selection,
            'registration' => $this->registration,
            'skills' => Skill::all(),
            'questionCategories' => QuestionTitle::all(),
        ]);
    }
}
