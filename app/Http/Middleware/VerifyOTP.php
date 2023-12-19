<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyOTP
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and email is verified
        if (auth()->check() && auth()->user()->email_verified_at !== null) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized. Email not verified.'], 401);
    }
}
