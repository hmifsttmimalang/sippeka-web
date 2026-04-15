<?php

namespace App\Services;

use App\Models\QuestionTitle;
use Illuminate\Pagination\LengthAwarePaginator;

class SubjectService
{
    public function getPaginatedSubjects(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return QuestionTitle::query()
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate($perPage);
    }

    public function deleteSubject(int $id): void
    {
        $subject = QuestionTitle::findOrFail($id);

        if ($subject->questions()->exists()) {
            throw new \Exception("Mata soal ini memiliki soal, tidak dapat dihapus!");
        }

        $subject->delete();
    }
}
