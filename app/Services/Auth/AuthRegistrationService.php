<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\FreelancerRepository;
use App\Repositories\EmployeeRepository;

class AuthRegistrationService
{
    protected $userRepository;
    protected $companyRepository;
    protected $freelancerRepository;
    protected $employeeRepository;

    public function __construct(
        UserRepository $userRepository,
        CompanyRepository $companyRepository,
        FreelancerRepository $freelancerRepository,
        EmployeeRepository $employeeRepository
    ) {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
        $this->freelancerRepository = $freelancerRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'username' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'userType' => 'required|in:company,freelancer,employee',
                // Add other validation rules based on userType
            ]);

            // Create User
            $user = $this->userRepository->createUser([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']), // Hash the password
                'userType' => $data['userType'],
            ]);

            if (!$user) {
                throw new \Exception('User creation failed');
            }

            // Handle UserType-specific data and create associated entity
            switch ($data['userType']) {
                case 'company':
                    $company = $this->companyRepository->createCompany([
                        'company_name' => $request->input('company_name'),
                        'business_type' => $request->input('business_type'),
                        'industry' => $request->input('industry'),
                        'registration_number' => $request->input('registration_number'),
                        'user_id' => $user->id,
                    ]);

                    if (!$company) {
                        throw new \Exception('Company creation failed');
                    }
                    break;

                case 'freelancer':
                    $freelancer = $this->freelancerRepository->createFreelancer([
                        'freelancer_name' => $request->input('freelancer_name'),
                        'industry' => $request->input('industry'),
                        'user_id' => $user->id,
                    ]);

                    if (!$freelancer) {
                        throw new \Exception('Freelancer creation failed');
                    }
                    break;

                case 'employee':
                    $employee = $this->employeeRepository->createEmployee([
                        'employee_name' => $request->input('employee_name'),
                        'phone_number' => $request->input('phone_number'),
                        'dob' => $request->input('dob'),
                        'gender' => $request->input('gender'),
                        'user_id' => $user->id,
                        'department_id' => $request->input('department_id'),
                    ]);

                    if (!$employee) {
                        throw new \Exception('Employee creation failed');
                    }
                    break;
            }

            return response()->json(['message' => 'User registered successfully', 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
