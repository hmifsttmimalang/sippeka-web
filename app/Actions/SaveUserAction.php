<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SaveUserAction
{
    /**
     * Create or update a user.
     */
    public function execute(array $data, ?int $id = null): User
    {
        $userData = [
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'role' => $data['role'],
        ];

        if (! empty($data['password'])) {
            $userData['password'] = Hash::make($data['password']);
        }

        if ($id) {
            $user = User::findOrFail($id);
            $user->update($userData);
        } else {
            $user = User::create($userData);
        }

        return $user;
    }
}
