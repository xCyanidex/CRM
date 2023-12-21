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
            
    public function findByEmail($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    // Add other methods as needed for users
}
