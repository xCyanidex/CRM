<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Auth\AuthLoginService;
use App\Services\Auth\AuthRegistrationService;
use App\Services\Auth\AuthLogoutService;
use App\Services\Auth\EmailVerificationService;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserLoginRequest;

/**
 * Controller handling authentication-related operations.
 * Manages user login, registration, logout, and email verification.
 */
class AuthController extends Controller
{
    // Service instances used for authentication and registration
    protected $loginService;
    protected $registrationService;
    protected $logoutService;
    protected $emailService;

    /**
     * Constructor to inject services needed for authentication and registration.
     *
     * @param AuthLoginService 
     * @param AuthRegistrationService
     * @param AuthLogoutService 
     * @param EmailVerificationService
     */
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

    /**
     * Handle user login.
     *
     * @param UserLoginRequest $request
     * @return mixed
     */
    public function login(UserLoginRequest $request)
    {
        // Validate the incoming login request
        $validatedData = $request->validated();

        // Perform login using the login service
        return $this->loginService->login($validatedData);
    }

    /**
     * Handle user registration.
     *
     * @param UserRegistrationRequest $request
     */
    public function register(UserRegistrationRequest $request)
    {
        // Validate the incoming registration request
        $validatedData = $request->validated();

        // Perform user registration using the registration service
        return $this->registrationService->register($validatedData);
    }

    /**
     * Handle user logout.
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        // Perform user logout using the logout service
        return $this->logoutService->logout($request);
    }

    /**
     * Handle email verification.
     *
     * @param Request $request
     */
    public function verify(Request $request)
    {
        // Perform email verification using the email service
        return $this->emailService->verify($request);
    }
}
