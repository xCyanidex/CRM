<?php

namespace App\Http\Controllers;
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


    public function createDepartment(Request $request)
    {
        try
        {
            $department = $this->departmentService->createDepartment($request->all());
            return response()->json(['message' => 'Department Created Successfully!', 'Department' => $department], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Department not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }       
    }
        


    public function getAllDepartments()
    {
        try
        {
            $departments = $this->departmentService->getAllDepartments();
            return response()->json(['message' => 'Departments Fetched Successfully!', 'Departments' => $departments], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Departments not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function findDepartmentByName($name)
    {    
        try {
            $department = $this->departmentService->findDepartmentByName($name);
            return response()->json(['message' => 'Department Fetched Successfully!', 'Department' => $department], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Department not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        try
        {
            $department = $this->departmentService->getDepartment($id);
            return response()->json(['message' => 'Department Fetched Successfully!', 'Departments' => $departments], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Department not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateDepartment($id, Request $request)
    {
        try {
            $updatedDepartment = $this->departmentService->updateDepartment($id, $request->all());
            return response()->json(['message' => 'Department Updated Successfully!', 'Department' => $updatedDepartment], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Department not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteDepartment($id)
    {
        try
        {
            $this->departmentService->deleteDepartment($id);
            return response()->json(['message' => 'Department Deleted Successfully!'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Department not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}