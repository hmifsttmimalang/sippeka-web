<?php

namespace App\Services\Admin;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    /**
     * Get dashboard statistics.
     *
     * @return array{totalRegistrations: int, passedRegistrations: int, registrationProgress: int, passRateProgress: float}
     */
    public function getStats(): array
    {
        $total = Registration::count();
        $passed = $this->calculatePassedCount();

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

    /**
     * Count registrations that passed selection:
     * (skill_test_score + interview_score) / 2 >= 70.
     */
    private function calculatePassedCount(): int
    {
        return Registration::query()
            ->whereNotNull('skill_test_score')
            ->whereNotNull('interview_score')
            ->whereRaw('((skill_test_score + interview_score) / 2) >= 70')
            ->count();
    }
}
