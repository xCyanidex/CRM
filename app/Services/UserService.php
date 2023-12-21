<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\FreelancerRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;
    protected $companyRepository;
    protected $freelancerRepository;
    protected $employeeRepository;

    public function __construct(UserRepository $userRepository, CompanyRepository $companyRepository, FreelancerRepository $freelancerRepository, EmployeeRepository $employeeRepository)
    {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
        $this->freelancerRepository = $freelancerRepository;
        $this->employeeRepository = $employeeRepository;
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
            
    public function findByEmail($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    // Add other methods as needed for users
}
