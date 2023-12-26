<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\DepartmentService;
use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\company;

class DepartmentController extends Controller
{
    protected $departmentService;
    protected $companyRepository;

    protected $userRepository;

    public function __construct(DepartmentService $departmentService, CompanyRepository $companyRepository, UserRepository $userRepository) 
        {
           $this->departmentService = $departmentService;
           $this->companyService = $companyRepository;
           $this->userRepository = $userRepository;
           
        }


    public function createDepartment(Request $request)
        {
            $user = Auth::user();

             if($user) {
                    $user_id = $user->id;
                    $company_id = Company::where('user_id',$user_id)->value('id');
                    $data = ['department_name'=>$request->input('department_name'),'company_id'=>$company_id];
                    $this->departmentService->createDepartment($data);
                    return response()->json(['message'=>'Department Created Successfully']);
       
                  }
    }
        


    public function getAllDepartments()
    {
        $departments =   $this->departmentService->getAllDepartments();
        if (!empty($departments)) {
            return response()->json(['Departments' => $departments], 200);
        } else {
            return response()->json(['message' => 'No Departments are there yet'], 404);
        }
    }



    public function show($id)
    {
            $department = $this->departmentService->getDepartmentById($id);

            if (!$department) {
                return response()->json(['message' => 'Department not found'], 404);
            }
            return response()->json(['department' => $department], 200); 
    }

    public function updateDepartment(Request $request, $id)
    {
       
        $department = $this->departmentService->getDepartmentById($id);

        if ($department) {
            $data = $request->all();
            $this->departmentService->updateDepartment($id, $data);
            return response()->json(['message' => 'Department Updated Successfully!'], 200);
        } else {
            return response()->json(['message' => 'Department not found'], 404);
        } 
    }

    public function deleteDepartment($id)
    {
        $department = $this->departmentService->getDepartmentById($id);
        if($department)
            {
                $this->departmentService->deleteDepartment($department);
                return response()->json(['message' => 'Department Deleted Successfully!'], 200);
            }else{
                return response()->json(['message' => 'Department Not Found'], 404);
            }
            
        
    }
}