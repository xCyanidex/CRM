<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Controller managing employee-related operations.
 * Handles retrieving, updating, and deleting employee information.
 */
class EmployeeController extends Controller
{
    // Instance of EmployeeService for handling employee-related operations
    protected $employeeService;

    /**
     * Constructor to inject the EmployeeService.
     *
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Get all employees.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllEmployees()
    {
        // Try fetching all employees
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

    /**
     * Get an employee by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmployee($id)
    {
        // Try fetching an employee by ID
        try
        {
            $employee = $this->employeeService->getEmployee($id);
            return response()->json(['message' => 'Employee Fetched Successfully!', 'Employee' => $employee], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Employee not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update an employee by ID.
     *
     * @param int     $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateEmployee($id, Request $request)
    {
        // Try updating an employee by ID
        try {
            $updatedEmployee = $this->employeeService->updateEmployee($id, $request->all());
            return response()->json(['message' => 'Employee Updated Successfully!', 'Employee' => $updatedEmployee], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Employee not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete an employee by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteEmployee($id)
    {
        // Try deleting an employee by ID
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
