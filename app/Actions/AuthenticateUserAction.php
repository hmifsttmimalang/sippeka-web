<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class AuthenticateUserAction
{
    /**
     * Authenticate a user.
     */
    public function execute(array $data): bool
    {
        // Cek apakah input login adalah email atau username
        $loginType = filter_var($data['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba autentikasi berdasarkan username atau email
        $credentials = [
            $loginType => $data['identifier'],
            'password' => $data['password'],
        ];

        // Cek jika pengguna ingin diingat
        $remember = $data['remember'] ?? false;

        return Auth::attempt($credentials, $remember);
    }
}
