<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;
    protected $companyRepository;

    public function __construct(UserRepository $userRepository, CompanyRepository $companyRepository)
    {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    public function register(array $data)
    {
        $entityType = $data['userType'];
        var_dump($data);

        if($entityType === 'company')
        {
            $company = $this->companyRepository->createCompany([
                'company_name' => $data['company_name'],
                'business_type' => $data['business_type'],
                'industry' => $data['industry'],
                'registration_number' => $data['registration_number']
            ]);
            
        }
    }

    public function findByEmail($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    // Add other methods as needed for users
}
