<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function createUser(array $userData)
    {
        return User::create($userData);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    // Add other methods as needed (update, delete, find by ID, etc.)
}
