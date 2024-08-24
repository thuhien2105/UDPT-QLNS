<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function handle($data)
    {
        $credentials = [
            'email' => $data['email'] ?? '',
            'password' => $data['password'] ?? '',
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return ['user' => $user, 'token' => $token];
        }

        return null;
    }
}
