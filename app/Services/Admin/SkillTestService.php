<?php

namespace App\Services\Admin;

use App\Models\SkillTest;
use Illuminate\Pagination\LengthAwarePaginator;

class SkillTestService
{
    public function getPaginatedTests(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return SkillTest::query()
            ->with(['category', 'skill'])
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate($perPage);
    }

    public function deleteTest(int $id): void
    {
        $test = SkillTest::findOrFail($id);

        if ($test->results()->exists()) {
            throw new \Exception('Tes keahlian memiliki hasil ujian, tidak dapat dihapus!');
        }

        $test->delete();
    }
}
