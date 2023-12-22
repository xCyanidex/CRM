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
            // var_dump($user);
             if($user) {
                    $user_id = $user->id;
                    // var_dump($user_id);
                    
                    $company_id = Company::where('user_id',$user_id)->value('id');
                    // var_dump($company_id);
                    $data = ['department_name'=>$request->input('department_name'),'company_id'=>$company_id];
                 
                    $this->departmentService->createDepartment($data);
                    return response()->json(['message'=>'Company Created Successfully']);
            // $company = $this->companyService->findById($request->all());
                  }
    }
        


    public function getAllDepartments()
    {
        $departments =   $this->departmentService->index();
      if(!$departments)
      {
          return response()->json(['message'=>'No Departments are there yet'],404);
      }else{
          return response()->json(['Departments'=>$departments],200);
      }
    }

    public function show($name)
        {
            $department = $this->departmentService->findByName($name);
            if($department)
                {
                    return response()->json(['Department'=>$department],200);
                }else{
                    return response()->json(['message'=>'Department not found'],404); 
                }
        }

    // public function createDepartment(Request $request)
    // {
    //     $request->validate([
    //         'department_name' => 'required|string|max:255',
    //         // Add other validation rules for department creation
    //     ]);

    //     // Authenticate the user using the provided token in the Authorization header
    //     $user = auth()->user();

    //     // Check if the user has a company associated with them
    //     if (!$user->company) {
    //         return response()->json(['message' => 'User does not belong to a company'], 400);
    //     }

    //     // Create the department and associate it with the company
    //     $department = $user->company->departments()->create([
    //         'department_name' => $request->input('department_name'),
    //         // Other department details
    //     ]);

    //     return response()->json(['message' => 'Department created successfully', 'department' => $department], 201);
    // }


    public function getDepartment($id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return response()->json(['message' => 'Department not found'], 404);
            }

            return response()->json(['department' => $department], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateDepartment(Request $request, $id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->update($request->all());

            return response()->json(['message' => 'Department Updated Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteDepartment($id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return response()->json(['message' => 'Department not found'], 404);
            }

            $department->delete(); // Deletes the department
            return response()->json(['message' => 'Department Deleted Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}