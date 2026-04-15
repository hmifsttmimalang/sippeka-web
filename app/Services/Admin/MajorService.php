<?php

namespace App\Services\Admin;

use App\Models\Major;
use Illuminate\Pagination\LengthAwarePaginator;

class MajorService
{
    public function getPaginatedMajors(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return Major::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate($perPage);
    }

    public function deleteMajor(int $id): void
    {
        $major = Major::findOrFail($id);
        
        if ($major->registrations()->exists()) {
           throw new \Exception("Tidak dapat menghapus jurusan ini karena masih memiliki pendaftar!");
        }

        $major->delete();
    }
}
