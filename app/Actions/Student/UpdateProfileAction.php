<?php

namespace App\Actions\Student;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateProfileAction
{
    public function execute(User $user, array $data): void
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (! empty($data['password'])) {
            $userData['password'] = Hash::make($data['password']);
        }

        $user->update($userData);

        if ($user->registration) {
            $user->registration->update([
                'name' => $data['name'],
            ]);
        }
    }
}
