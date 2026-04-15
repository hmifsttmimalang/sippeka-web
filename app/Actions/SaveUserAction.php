<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SaveUserAction
{
    public function execute(array $data, ?int $id = null): User
    {
        $userData = collect($data)->only(['name', 'username', 'email', 'role']);

        if (!empty($data['password'])) {
            $userData->put('password', Hash::make($data['password']));
        }

        return User::updateOrCreate(['id' => $id], $userData->toArray());
    }
}
