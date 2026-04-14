<?php

namespace App\Livewire\Admin;

use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Dashboard Overview')]
class Dashboard extends Component
{
    public int $totalRegistrations = 0;

    public int $passedRegistrations = 0;

    public float $registrationProgress = 0;

    public float $passedProgress = 0;

    public $recentRegistrations;

    public function mount(): void
    {
        // Total Registrations
        $this->totalRegistrations = Registration::count();

        // Calculate Passed based on Logic: (skill_test_score + interview_score) / 2 >= 70
        $this->passedRegistrations = Registration::whereRaw('(skill_test_score + interview_score) / 2 >= 70')->count();

        // Registration Progress (100% if > 0)
        $this->registrationProgress = $this->totalRegistrations > 0 ? 100 : 0;

        // Passed Progress Percentage
        $this->passedProgress = $this->totalRegistrations > 0
            ? ($this->passedRegistrations / $this->totalRegistrations) * 100
            : 0;

        // Latest Registrations within 24 Hours
        $this->recentRegistrations = Registration::latest()
            ->with('skill')
            ->where('created_at', '>=', now()->subDay())
            ->take(10)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.admin.dashboard');

    }
}
