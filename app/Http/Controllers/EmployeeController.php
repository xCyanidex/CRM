<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::all();
        return response()->json(['employees' => $employees], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string',
            'phone_number' => 'required',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            // Other validations...
        ]);

        // Assume you retrieve the authenticated user (company owner)
        $authenticatedUser = Auth::user();

        // Assume you get the company and department information of the authenticated user
        $company = $authenticatedUser->company;
        $department = $company->departments()->first(); // Assuming the company has at least one department

        // Create a new user for the employee
        $employeeUser = User::create([
            'email' => $request->email, // Change as per your requirements
            'password' => Hash::make($request->password), // Set a default or temporary password
            // Add other user-related fields as needed
        ]);

        // Create an employee associated with the new user, company, and department
        $employee = $company->employees()->create([
            'employee_name' => $request->employee_name,
            'phone_number' => $request->phone_number,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'user_id' => $employeeUser->id, // Associate the new user with the employee
            'department_id' => $department->id, // Assuming department is retrieved
            // Other employee-related fields...
        ]);

        return response()->json(['employee' => $employee, 'message' => 'Employee added successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employees::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        return response()->json(['user' => $employee], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employees::findOrFail($id);
        $employee->update($request->all());

        return response()->json(['message' => 'Employee Updated Successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employees::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete(); // Deletes the user
        return response()->json(['message' => 'Employee Deleted Successfully!'], 200);
    }
}
