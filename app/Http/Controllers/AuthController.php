<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Auth\AuthLoginService;
use App\Services\Auth\AuthRegistrationService;
use App\Services\Auth\AuthLogoutService;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserLoginRequest;

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

    public function login(UserLoginRequest $request)
    {
        $validatedData = $request->validated();
        var_dump($validatedData);
        return $this->loginService->login($validatedData);
    }


    public function register(UserRegistrationRequest $request)
    {
        $data = $request->validated();
        return $this->registrationService->register($data);
    }

    public function logout(Request $request)
    {
        return $this->logoutService->logout($request);
    }
}
