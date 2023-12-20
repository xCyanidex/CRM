<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Company;
use App\Models\Freelancers;

// use App\Models\Company;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($credentials)
    {
        try {
            $user = $this->userRepository->findByEmail($credentials['email']);

            if (!$user || !password_verify($credentials['password'], $user->password)) {
                throw new \Exception('Invalid credentials');
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['token' => $token], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }


    public function register(array $userData)
    {
        try {
            $user = User::create([
                'username' => $userData['username'],
                'email' => $userData['email'],
                'password' => bcrypt($userData['password']),
                'entity_type' => $userData['entity_type'],
            ]);

            if ($userData['entity_type'] === 'company') {
                $company = Company::create([
                    'company_name' => $userData['company_name'],
                    'business_type' => $userData['business_type'],
                    'industry' => $userData['industry'],
                    'registration_number' => $userData['registration_number'],
                    'website' => $userData['website'],
                    'logo' => $userData['logo']
                ]);
                $user->entity()->associate($company);

            } elseif ($userData['entity_type'] === 'freelancer') {
                $freelancer = Freelancer::create([
                    'freelancer_name' => $userData['freelancer_name'],
                    'industry' => $userData['industry'],
                ]);
                $user->entity()->associate($freelancer);

            } elseif ($userData['entity_type'] === 'employee') {
                $employee = Employee::create([
                    
                    'employee_name' => $userData['employee_name'],
                    'phone_number' => $userData['phone_number'],
                    'dob' => $userData['dob'],
                    'gender' => $userData['gender'],
                    'department_id' => $userData['department_id'],
                ]);
                $user->entity()->associate($employee);
            }
            
            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }

    public function logout(User $user)
    {
        try {
            $user->tokens()->delete();
    
            return response()->json(['message' => 'Logged out successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}









?>