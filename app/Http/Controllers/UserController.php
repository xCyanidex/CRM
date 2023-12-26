<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllUsers()
    {
        $users = $this->userService->getAllUsers();
        return response()->json(['users' => $users], 200);
    }

    // public function createUser(Request $request)
    // {
    //     $data = $request->all();
        
    //     $user = $this->userService->createUser($data);
    //     if ($user) {
    //         return response()->json(['user' => $user], 200);
    //     } else {
    //         return response()->json(['message' => 'Registration failed'], 500);
    //     }
    // }

    public function getUser($id)
    {
        $user = $this->userService->getUser($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    public function updateUser(Request $request, $id)
    {
        $result = $this->userService->updateUser($request->all(), $id);

        if ($result) {
            return response()->json(['message' => 'User Updated Successfully!'], 200);
        } else {
            return response()->json(['message' => 'User not found or update failed'], 404);
        }
    }

    public function deleteUser($id)
    {
        $result = $this->userService->deleteUser($id);

        if ($result) {
            return response()->json(['message' => 'User Deleted Successfully!'], 200);
        } else {
            return response()->json(['message' => 'User not found or deletion failed'], 404);
        }
    }
}
