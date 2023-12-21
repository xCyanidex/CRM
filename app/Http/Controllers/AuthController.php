<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

use App\Services\AuthService;

use App\Models\User;
use App\Models\Company;
use App\Models\Freelancers;


class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function login(Request $request, AuthService $authService)
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

    public function register(Request $request, $userData)
    {
        // $userData = $request->validate([
        //     'username' => 'required|string|unique:users',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|string|min:6',
        //     'entity_type' => 'required|string|in:company,freelancer,employee',
        // ]);

        $user = $this->authService->register($userData);
        return response()->json(['message' => 'User registered successfully']);
    }

    public function logout(Request $request, AuthService $authService)
    {
        $authService->logout($request->user());
        return response()->json(['message' => 'Logged out successfully']);
    }


}
