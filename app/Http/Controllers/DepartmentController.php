<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\DepartmentService;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
        {
           $this->departmentService = $departmentService;
           
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

    public function createDepartment(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            // Add other validation rules for department creation
        ]);

        // Authenticate the user using the provided token in the Authorization header
        $user = auth()->user();

        // Check if the user has a company associated with them
        if (!$user->company) {
            return response()->json(['message' => 'User does not belong to a company'], 400);
        }

        // Create the department and associate it with the company
        $department = $user->company->departments()->create([
            'department_name' => $request->input('department_name'),
            // Other department details
        ]);

        return response()->json(['message' => 'Department created successfully', 'department' => $department], 201);
    }


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