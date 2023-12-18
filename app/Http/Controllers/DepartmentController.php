<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getAllDepartments()
    {
        try{
            $departments = Department::all();
            
            return response()->json(['departments' => $departments, 'message' => 'Departments Fetched Successfully!'], 200);

        } catch(\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createDepartment(Request $request)
    {
        try{
            $request->validate([
                'name' =>'required',
                'company_id' =>'required|exists:companies,id',
            ]);
    
            $department = Department::create($request->all());
    
            return response()->json(['department' => $department,'message' => 'Department Created Successfully!'], 201);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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