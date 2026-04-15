<?php

namespace App\Livewire\Instructor;

use App\Services\Instructor\DashboardService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
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

    /**
     * @var Collection
     */
    public $newRegistrations;

    public function mount(DashboardService $service): void
    {
        $stats = $service->getStats();

        $this->totalRegistrations = $stats['totalRegistrations'];
        $this->passedRegistrations = $stats['passedRegistrations'];
        $this->registrationProgress = $stats['registrationProgress'];
        $this->passRateProgress = $stats['passRateProgress'];

        $this->newRegistrations = $service->getRecentRegistrations();
    }

    public function render(): View
    {
        return view('livewire.instructor.dashboard', [
            'totalParticipants' => $this->totalRegistrations,
            'latestEvaluations' => $this->newRegistrations,
        ]);
    }
}
