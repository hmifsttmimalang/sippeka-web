<?php

namespace App\Livewire\Instructor;

use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.instructor_app')]
#[Title('Instructor Dashboard')]
class Dashboard extends Component
{
    public int $totalRegistrations = 0;

    public int $passedRegistrations = 0;

    public float $registrationProgress = 0;

    public float $passRateProgress = 0;

    public $newRegistrations;

    public function mount(): void
    {
        // Total Registrations
        $this->totalRegistrations = Registration::count();

        // Calculate Passed based on logic: (skill_score + interview_score) / 2 >= 70
        $this->passedRegistrations = Registration::whereRaw('(skill_score + interview_score) / 2 >= 70')->count();

        // Registration Progress (100% if > 0)
        $this->registrationProgress = $this->totalRegistrations > 0 ? 100 : 0;

        // Pass Rate Progress Percentage
        $this->passRateProgress = $this->totalRegistrations > 0
            ? ($this->passedRegistrations / $this->totalRegistrations) * 100
            : 0;

        // Latest Registrations within 24 Hours
        $this->newRegistrations = Registration::latest()
            ->with('skill')
            ->where('created_at', '>=', now()->subDay())
            ->take(10)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.instructor.dashboard', [
            'totalParticipants' => $this->totalRegistrations,
            'latestEvaluations' => $this->newRegistrations,
        ]);
    }
}
