<?php

namespace App\Livewire\Admin;

use App\Services\Admin\DashboardService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Dashboard Overview')]
class Dashboard extends Component
{
    public int $totalRegistrations = 0;

    public int $registrationProgress = 0;

    public int $passedRegistrations = 0;

    public float $passRateProgress = 0;

    /**
     * Renders the dashboard view with statistics.
     *
     * @param  DashboardService  $service  The dashboard service which provides statistics.
     * @return View The rendered view.
     */
    public function render(DashboardService $service): View
    {
        $stats = $service->getStats();

        $this->totalRegistrations = $stats['totalRegistrations'];
        $this->registrationProgress = $stats['registrationProgress'];
        $this->passedRegistrations = $stats['passedRegistrations'];
        $this->passRateProgress = $stats['passRateProgress'];

        return view('livewire.admin.dashboard', [
            'recentRegistrations' => $service->getRecentRegistrations(),
        ]);
    }
}
