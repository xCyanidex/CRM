<?php

/**
 * AuthRegistrationService Class
 *
 * This class manages user registration based on their type (company, freelancer, employee).
 * It handles user creation, associated entity creation, role assignment, and email verification.
 */

namespace App\Services\Auth;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\FreelancerRepository;
use App\Repositories\EmployeeRepository;
use App\Services\DepartmentService;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Spatie\Permission\Models\Role;


class AuthRegistrationService
{
    protected $userRepository;
    protected $companyRepository;
    protected $freelancerRepository;
    protected $employeeRepository;
    protected $departmentService;

    public function __construct(
        UserRepository $userRepository,
        CompanyRepository $companyRepository,
        FreelancerRepository $freelancerRepository,
        EmployeeRepository $employeeRepository,
        DepartmentService $departmentService
    ) {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
        $this->freelancerRepository = $freelancerRepository;
        $this->employeeRepository = $employeeRepository;
        $this->departmentService = $departmentService;
    }

     /**
     * Register a new user based on their type.
     * Assign proper permissions according to their role
     *
     * @param array $data User registration data
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(array $data)
    {
        try {

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
                        'company_name' => $data['company_name'],
                        'business_type' => $data['business_type'],
                        'industry' => $data['industry'],
                        'registration_number' => $data['registration_number'],
                        'user_id' => $user->id,
                    ]);

                    $companyAdminPermissions = [
                        'create department', 'view department', 'update department', 'delete department',
                        'create employee', 'view employee', 'update employee', 'delete employee',
                        
                    ];

                    $role =  Role::where('name', 'company-admin')->firstOrFail()->syncPermissions($companyAdminPermissions);

                    $user->assignRole($role);

                    if (!$company) {
                        throw new \Exception('Company creation failed');
                    }
                    break;

                case 'freelancer':
                    $freelancer = $this->freelancerRepository->createFreelancer([
                        'freelancer_name' => $data['freelancer_name'],
                        'industry' => $data['industry'],
                        'user_id' => $user->id,
                    ]);

                    $freelancerPermissions = [ 'create project', 'view project', 'update project', 'delete project'];
                    
                    $role =  Role::where('name', 'freelancer')->firstOrFail()->syncPermissions($freelancerPermissions); 
                    
                    $user->assignRole($role);

                    if (!$freelancer) {
                        throw new \Exception('Freelancer creation failed');
                    }
                    break;

                case 'employee':
                    $employee = $this->employeeRepository->createEmployee([
                        'employee_name' => $data['employee_name'],
                        'phone_number' => $data['phone_number'],
                        'dob' => $data['dob'],
                        'gender' => $data['gender'],
                        'user_id' => $user->id,
                        'department_id' => $data['department_id'],
                    ]);

                    $employeePermissions = ['view task'];
                    $role =  Role::where('name', 'employee')->firstOrFail()->syncPermissions($employeePermissions);

                    $user->assignRole($role);
                    if (!$employee) {
                        throw new \Exception('Employee creation failed');
                    }
                    break;

                default:
                    throw new \Exception('Invalid user type');
            }

            
                      $otp = rand(100000, 999999);

                      // Save OTP to the user
                       $user->otp = $otp;
                       $user->save();

                    //    var_dump($otp);

                        // Send OTP in the verification email
                        Mail::to($user)->send(new VerifyEmail($user, $otp));

                     //Assigning a Token

                     $token = $user->createToken('api-token')->plainTextToken;
                     

            return response()->json(['message' => 'User registered successfully! Check Inbox for OTP!','token'=>$token], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
