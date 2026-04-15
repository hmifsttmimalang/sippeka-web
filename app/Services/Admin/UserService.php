<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getPaginatedUsers(string $search = '', string $role = '', int $perPage = 10): LengthAwarePaginator
    {
        return User::query()
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($role, fn($q) => $q->where('role', $role))
            ->latest()
            ->paginate($perPage);
    }

    public function deleteUser(int $id): void
    {
        if (Auth::id() === $id) {
            throw new \Exception('Anda tidak bisa menghapus akun sendiri!');
        }

        User::findOrFail($id)->delete();
    }
}
