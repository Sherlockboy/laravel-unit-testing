<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\User;

class UserService
{
    public function search(int $user_id): User
    {
        $user = User::find($user_id);

        if(!$user) {
            throw new UserNotFoundException("User not found with id: {$user_id}");
        }

        return $user;
    }
}
