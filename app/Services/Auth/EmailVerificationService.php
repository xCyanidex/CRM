<?php

/**
 * EmailVerificationService Class
 *
 * This class manages the verification of user email using OTP.
 */

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EmailVerificationService
{
    /**
     * Verify the user's email using OTP.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing OTP
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
        $user = Auth::user();

        $userEmail = $user->email;

        if (!$userEmail) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $enteredOTP = $request->input('otp');
        $storedOTP = $user->otp;

        if ($storedOTP === $enteredOTP) {
            // OTP matches, update user's OTP and mark email as verified
            $user->update(['otp' => null, 'email_verified_at' => now()]);
            // Generate API token if needed
            // $token = $user->createToken('api-token')->plainTextToken;
            return response()->json(['message' => 'OTP verified successfully']);
        } else {
            // Invalid OTP provided
            return response()->json(['message' => 'Invalid OTP'], 422);
        }
    }
}
