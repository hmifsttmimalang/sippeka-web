<?php

namespace App\Services\Admin;

use App\Models\Registration;
use Illuminate\Pagination\LengthAwarePaginator;

class EvaluationService
{
    /**
     * Get registrations that have completed the skill test and are eligible for evaluation.
     */
    public function getEvaluatableRegistrations(string $search = '', string $skillId = '', int $perPage = 10): LengthAwarePaginator
    {
        return Registration::query()
            ->with(['skill', 'user'])
            ->whereNotNull('skill_test_score')
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->when($skillId, fn ($q) => $q->where('skill_id', $skillId))
            ->latest()
            ->paginate($perPage);
    }
}
