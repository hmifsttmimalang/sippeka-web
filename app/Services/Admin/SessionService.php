<?php

namespace App\Services\Admin;

use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SessionService
{
    public function getPaginatedSessions(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return SkillTestSession::with('skillTest')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhereHas('skillTest', fn ($st) => $st->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getSessionAttempts(int $sessionId, string $search = ''): Collection
    {
        return TestAttempt::with(['registration.skill'])
            ->where('skill_test_session_id', $sessionId)
            ->when($search, function ($q) use ($search) {
                $q->whereHas('registration', fn ($reg) => $reg->where('name', 'like', "%{$search}%"));
            })
            ->get();
    }

    public function deleteSession(int $id): void
    {
        $session = SkillTestSession::findOrFail($id);

        if ($session->attempts()->exists()) {
            throw new \Exception('Sesi ini tidak dapat dihapus karena masih memiliki peserta yang mengikuti ujian pada sesi ini!');
        }

        $session->delete();
    }
}
