<?php


class VerifyEmail{

    public function verify(Request $request)
{
    $user = $request->user();
    $userEmail = $user->email;

    if (! $userEmail) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $enteredOTP = $request->input('otp');
    $storedOTP = $user->otp;

    if ($storedOTP === $enteredOTP) {

        $user->update(['otp' => null, 'email_verified_at' => now()]);
        //  $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['message' => 'OTP verified successfully']);
    } else {
        return response()->json(['message' => 'Invalid OTP'], 422);
    }
}

}



