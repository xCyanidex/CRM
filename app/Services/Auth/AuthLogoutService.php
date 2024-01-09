<?php

/**
 * AuthLogoutService Class
 *
 * This class handles user logout functionality by revoking user tokens to invalidate sessions.
 */

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLogoutService
{
    /**
     * Logout the authenticated user by revoking tokens.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                throw new \Exception('User not found');
            }

            // Revoke the user's tokens to invalidate the session
            $user->tokens()->delete();

            // Respond with success message
            return response()->json(['message' => 'Logged out successfully'], 200);
        } catch (\Exception $e) {
            // Catch and handle any exceptions during logout process
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
