<?php

namespace App\Business\Services;

use App\Models\User;

class UsersService
{
    public function __construct(
        protected EncryptService $encryptService,
    ) {}

    public function encryptEmail(Int $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            throw new \Exception('User not found');
        }

        return $this->encryptService->encrypt($user->email);
    }
}
