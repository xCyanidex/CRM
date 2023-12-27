<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
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

    public function findUserById($id)
    {
        return $this->user->findOrFail($id);
    }

    public function updateUser($id, array $data)
    {
        return $this->user->findOrFail($id)->update($data);
        // $user->update($data);
    }

    public function deleteUser($id)
    {
        return $this->user->findOrFail($id)->delete();
    }
}
