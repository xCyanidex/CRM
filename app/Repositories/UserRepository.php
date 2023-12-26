<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createUser(array $data)
    {
        return $this->user->create($data);
    }

    public function findByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function getAllUsers()
    {
        return $this->user->all();
    }

    public function getUserById($id)
    {
        try {
            return $this->user->findOrFail($id);
        } catch (\Exception $e) {
            return null; // Return null if user not found
        }
    }

    public function updateUser($id, array $data)
    {
        $user = $this->getUserById($id);

        if (!$user) {
            return ['message' => 'User not found!']; // Return an array instead of using response()->json()
        }

        try {
            $user->update($data);
            return $user;
        } catch (\Exception $e) {
            return ['message' => $e->getMessage()]; // Return an array with error message
        }
    }

    public function deleteUser($id)
    {
        try {
            return $this->user->destroy($id);
        } catch (\Exception $e) {
            return ['message' => $e->getMessage()]; // Return an array with error message
        }
    }

    // Add other methods as needed (update, delete, find by ID, etc.)
}
