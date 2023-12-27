<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Auth\AuthLoginService;
use App\Services\Auth\AuthRegistrationService;
use App\Services\Auth\AuthLogoutService;
use App\Services\Auth\EmailVerificationService;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserLoginRequest;

class AuthController extends Controller
{
    protected $loginService;
    protected $registrationService;
    protected $logoutService;
    protected $emailService;

    public function __construct(
        AuthLoginService $loginService,
        AuthRegistrationService $registrationService,
        AuthLogoutService $logoutService,
        EmailVerificationService $emailService
    )
    {
        $this->loginService = $loginService;
        $this->registrationService = $registrationService;
        $this->logoutService = $logoutService;
        $this->emailService = $emailService;
    }

    public function login(UserLoginRequest $request)
    {
        $validatedData = $request->validated();
        
        return $this->loginService->login($validatedData);
    }


    public function register(UserRegistrationRequest $request)
    {
        $validatedData = $request->validated();

        return $this->registrationService->register($validatedData);
        
    }

    public function logout(Request $request)
    {
        return $this->logoutService->logout($request);
    }

    public function verify(Request $request)
    {
        return $this->emailService->verify($request);
    }

}
