<?php

namespace App\Services;

use App\Models\User;

class LogoutService
{
    public function handle($data)
    {
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            $user->currentAccessToken()->delete();
            return $user;
        }

        return null;
    }
}
