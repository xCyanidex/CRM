<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    protected $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function updateUser($id, array $data)
    {
        return User::whereId($id)->update($data);
    }

    public function deleteUser($id)
    {
        return $this->user->destroy($id);
    }

    // Add other methods as needed (update, delete, find by ID, etc.)
}
