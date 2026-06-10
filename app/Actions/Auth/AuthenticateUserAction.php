<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class AuthenticateUserAction
{
    public function execute(array $data): bool
    {
        $loginType = filter_var($data['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $data['identifier'],
            'password' => $data['password'],
        ];

        $remember = $data['remember'] ?? false;

        return Auth::attempt($credentials, $remember);
    }
}
