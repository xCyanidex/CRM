<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\FreelancerRepository;
use App\Repositories\CompanyRepository;

use App\Models\User;
use App\Models\Company;
use App\Models\Freelancers;

// use App\Models\Company;

class AuthService
{
    protected $userRepository;
    protected $employeeRepository;
    protected $freelancerRepository;

    protected $companyRepository;

    public function __construct(UserRepository $userRepository, EmployeeRepository $employeeRepository, FreelancerRepository $freelancerRepository, CompanyRepository $companyRepository) 
    {
        $this->userRepository = $userRepository;
        $this->employeeRepository = $employeeRepository;
        $this->freelancerRepository = $freelancerRepository;
        $this->companyRepository = $companyRepository;
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


    public function register(array $data)
    {
        $user = $this->userRepository->createUser([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'userType' => $data['userType'],
        ]);
    
        $entityType = $data['userType'];
    
        if ($user) {
            if ($entityType === 'company') {
                $company = $this->companyRepository->createCompany([
                    'company_name' => $data['company_name'],
                    'business_type' => $data['business_type'],
                    'industry' => $data['industry'],
                    'registration_number' => $data['registration_number'],
                    'user_id' => $user->id, // Assigning the user_id to the company
                ]);
                if (!$company) {
                    throw new \Exception('Company creation failed');
                }
            } elseif ($entityType === 'freelancer') {
                $freelancer = $this->freelancerRepository->createFreelancer([
                    'freelancer_name' => $data['freelancer_name'],
                    'industry' => $data['industry'],
                    'user_id' => $user->id, // Assigning the user_id to the freelancer
                ]);
                if (!$freelancer) {
                    throw new \Exception('Freelancer creation failed');
                }
            }
            elseif ($entityType === 'employee') {
                $employee = $this->employeeRepository->createEmployee([
                    'employee_name' => $data['employee_name'],
                    'phone_number' => $data['phone_number'],
                    'dob' => $data['dob'],
                    'gender' => $data['gender'],
                    'user_id' => $user->id, // Assigning the user_id to the freelancer
                    'department_id' => $data['department_id'],
                    
                ]);
                if (!$employee) {
                    throw new \Exception('Employee creation failed');
                }
            }
            return $user;
        } else {
            throw new \Exception('User creation failed');
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