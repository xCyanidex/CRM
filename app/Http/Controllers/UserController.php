<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    public function createUser(Request $request)
    {
        $data = $request->all();
        
        $user = $this->userService->register($data);
        if ($user) {
            // Registration success
            return response()->json(['user' => $user]);
        } else {
            // Registration failed
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }

    public function getUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json(['message' => 'User Updated Successfully!'], 200);
    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete(); // Deletes the user
        return response()->json(['message' => 'User Deleted Successfully!'], 200);
    }
}
