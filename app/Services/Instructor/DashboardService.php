<?php

namespace App\Services\Instructor;

use App\Actions\Registrations\CalculatePassedRegistrationAction;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function __construct(
        protected CalculatePassedRegistrationAction $calculatePassedAction
    ) {}

    /**
     * Get dashboard statistics for instructors.
     */
    public function getStats(): array
    {
        $total = Registration::count();
        $passed = $this->calculatePassedAction->execute();

        return [
            'totalRegistrations' => $total,
            'passedRegistrations' => $passed,
            'registrationProgress' => $total > 0 ? 100 : 0,
            'passRateProgress' => $total > 0 ? ($passed / $total) * 100 : 0,
        ];
    }

    /**
     * Get latest registrations within the last 24 hours.
     */
    public function getRecentRegistrations(int $limit = 10): Collection
    {
        return Registration::query()
            ->latest()
            ->with('skill')
            ->where('created_at', '>=', now()->subDay())
            ->take($limit)
            ->get();
    }
}
