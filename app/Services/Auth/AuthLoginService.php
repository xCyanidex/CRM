<?php

/**
 * AuthLoginService Class
 *
 * This class handles user authentication functionality.
 * It provides methods to facilitate user login and token generation.
 */

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLoginService
{
    /**
     * Attempt to log in the user.
     *
     * @param array $data The user credentials (email and password)
     * @return \Illuminate\Http\JsonResponse
     */
    public function login($data)
    {
        
        // Attempt login with provided credentials
        if (!Auth::attempt($data)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Generate a token for the authenticated user
        $token = Auth::user()->createToken('authToken')->plainTextToken;

        // Respond with success message and generated token
        return response()->json(['message' => 'You have logged in', 'token' => $token], 200);
    }
}
