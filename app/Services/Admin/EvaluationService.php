<?php

namespace App\Services\Admin;

use App\Models\Registration;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class EvaluationService
{
    public function getEvaluatableRegistrations(string $search = '', string $skillId = '', int $perPage = 10): LengthAwarePaginator
    {
        return Registration::query()
            ->with(['skill', 'user'])
            ->whereNotNull('skill_test_score')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->when($skillId, fn($q) => $q->where('skill_id', $skillId))
            ->latest()
            ->paginate($perPage);
    }

    public function canEvaluate(): bool
    {
        $user = Auth::user();
        return $user && $user->isInstructor();
    }
}
