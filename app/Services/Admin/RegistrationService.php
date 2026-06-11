<?php

namespace App\Services\Admin;

use App\Models\Registration;
use Illuminate\Pagination\LengthAwarePaginator;

class RegistrationService
{
    public function getFilteredRegistrants(string $search = '', string $filterSkill = '', int $perPage = 10): LengthAwarePaginator
    {
        return Registration::query()
            ->with('skill')
            ->when(
                $search,
                fn ($q) => $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                })
            )
            ->when($filterSkill, fn ($q) => $q->where('skill_id', $filterSkill))
            ->latest()
            ->paginate($perPage);
    }

    public function deleteRegistration(int $id): void
    {
        Registration::findOrFail($id)->delete();
    }
}
