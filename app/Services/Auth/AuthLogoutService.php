<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLogoutService
{
    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                throw new \Exception('User not found');
            }

            // Revoke the user's tokens to invalidate the session
            $user->tokens()->delete();

            return response()->json(['message' => 'Logged out successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
