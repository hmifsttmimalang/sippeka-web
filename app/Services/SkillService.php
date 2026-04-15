<?php

namespace App\Services;

use App\Models\Skill;
use Illuminate\Pagination\LengthAwarePaginator;

class SkillService
{
    public function getPaginatedSkills(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return Skill::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->withCount('registrations')
            ->latest()
            ->paginate($perPage);
    }

    public function deleteSkill(int $id): void
    {
        $skill = Skill::findOrFail($id);

        if ($skill->registrations_count > 0 || $skill->registrations()->exists()) {
            throw new \Exception('Keahlian ini tidak bisa dihapus karena masih memiliki pendaftar!');
        }

        $skill->delete();
    }
}
