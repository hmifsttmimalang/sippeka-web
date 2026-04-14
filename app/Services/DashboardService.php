<?php

namespace App\Services;

use App\Models\Registration;
use App\Actions\Registrations\CalculatePassedRegistrationAction;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function __construct(
        protected CalculatePassedRegistrationAction $calculatePassed
    ) {}

    public function getStats(): array
    {
        $total = Registration::count();
        $passed = $this->calculatePassed->execute();

        return [
            'totalRegistrations' => $total,
            'passedRegistrations' => $passed,
            'registrationProgress' => $total > 0 ? 100 : 0,
            'passedProgress' => $total > 0 ? ($passed / $total) * 100 : 0,
        ];
    }

    public function getRecentActivities(int $limit = 10): Collection
    {
        return Registration::latest()
            ->with('skill')
            ->where('created_at', '>=', now()->subDay())
            ->take($limit)
            ->get();
    }
}
