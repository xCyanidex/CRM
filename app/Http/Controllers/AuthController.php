<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Auth\AuthLoginService;
use App\Services\Auth\AuthRegistrationService;
use App\Services\Auth\AuthLogoutService;

class AuthController extends Controller
{
    protected $loginService;
    protected $registrationService;
    protected $logoutService;

    public function __construct(
        AuthLoginService $loginService,
        AuthRegistrationService $registrationService,
        AuthLogoutService $logoutService
    ) {
        $this->loginService = $loginService;
        $this->registrationService = $registrationService;
        $this->logoutService = $logoutService;
    }

    public function login(Request $request)
    {
        return $this->loginService->login($request);
    }

    public function register(Request $request)
    {
        return $this->registrationService->register($request);
    }

    public function logout(Request $request)
    {
        return $this->logoutService->logout($request);
    }
}
