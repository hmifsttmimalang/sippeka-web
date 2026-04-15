<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Pagination\LengthAwarePaginator;

class RankingService
{
    public function getPaginatedRankings(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return Registration::query()
            ->with('skill')
            ->select('registrations.*')
            ->selectRaw('((skill_test_score + interview_score) / 2) as average_score')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderByDesc('average_score')
            ->paginate($perPage);
    }
}
