<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Requests\UserLoginRequest;
use Illuminate\Http\Requests\UserRegistrationRequest;
use App\Services\UserService;

use App\Services\AuthService;



class AuthController extends Controller
{
    protected $authService;
    protected $UserService;

    public function __construct(UserService $UserService, AuthService $authService){
        $this->UserService = $UserService;
        $this->authService = $authService;
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $token = $this->authService->login($credentials);
        
        if(!$token)
        {
            return response()->json(['message'=>'Invalid Credentials'], 401);
        }

        return response()->json(['message'=>'You have Logged In', 'token' => $token], 200);
    }

    public function register(UserRegistrationRequest $request)
    {
        $data = $request->all();
        
        $user = $this->authService->register($data);
        if ($user) {
            // Registration success
            return response()->json(['user' => $user]);
        } else {
            // Registration failed
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }

    public function logout(Request $request)
    {
        $authService->logout($request->user());
        return response()->json(['message' => 'Logged out successfully']);
    }


}
