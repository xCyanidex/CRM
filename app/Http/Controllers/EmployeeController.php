<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function getAllEmployees()
    {
        try
        {
            $employees = $this->employeeService->getAllEmployees();
            return response()->json(['message' => 'Employees Fetched Successfully!', 'Employees' => $employees], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Employees not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getEmployee($id)
    {
        try
        {
            $employee = $this->employeeService->getEmployee($id);
            return response()->json(['message' => 'Employee Fetched Successfully!', 'Employees' => $employees], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Employee not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateEmployee($id, Request $request)
    {
        try {
            $updatedEmployee = $this->employeeService->updateEmployee($id, $request->all());
            return response()->json(['message' => 'Employee Updated Successfully!', 'Employee' => $updatedEmployee], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Employee not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteEmployee($id)
    {
        try
        {
            $this->employeeService->deleteEmployee($id);
            return response()->json(['message' => 'Employee Deleted Successfully!'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Employee not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

 
}
