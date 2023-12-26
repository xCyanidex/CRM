<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
            
    public function findByEmail($email)
    {
        try {
            $user = $this->userRepository->findByEmail($email);
            return response()->json(['message' => "User fetched successfully", 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function getAllUsers()
    {
        try {
            $users = $this->userRepository->getAllUsers();
            return response()->json(['message' => 'Users fetched successfully', 'users' => $users]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function getUser($id)
    {
        try {
            $user = $this->userRepository->getUserById($id);
            return response()->json(['message' => 'User fetched successfully', 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function updateUser(array $data, $id)
    {
        try {
            $userUpdated = $this->userRepository->updateUser($id, $data);
            return response()->json(['message' => 'User updated successfully', 'user' => $userUpdated]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function deleteUser($id)
    {
        try {
            $deleted = $this->userRepository->deleteUser($id);
            return response()->json(['message' => 'User deleted successfully', 'deleted' => $deleted]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
