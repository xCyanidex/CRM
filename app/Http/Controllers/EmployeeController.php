<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;

        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        if($employees)
            {
                return response()->json(['employees' => $employees], 200);
            }else{
                return response()->json(['message'=>'No Employees are there!'], 404);
            }
        
    }

    /**
     * Store a newly created resource in storage.
     */
  

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        return response()->json(['employee' => $employee], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = $this->employeeService->getEmployeeById($id);

        if ($employee) {
            $data = $request->all();
            $this->employeeService->updateEmployee($id, $data);
            return response()->json(['message' => 'Employee Updated Successfully!'], 200);
        } else {
            return response()->json(['message' => 'Employee not found'], 404);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = $this->employeeService->getEmployeeById($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $this->employeeService->deleteEmployee($employee); // Deletes the user
        return response()->json(['message' => 'Employee Deleted Successfully!'], 200);
    }
}
