<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Company;
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

        $user = Auth::user();
        $user_id = $user->user_id;
        $company_id = Company::Where('user_id', $user_id);


        $request->validate([
            'employee_name' => 'required|string',
            'phone_number' => 'required|unique:employees,phone_number|email',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'user_id' => 'required|integer',
            'company_id' => 'required|integer',
        ]);

        $employees = Employees::create([
            'employee_name' => $request->employee_name,
            'phone_number' => $request->phone_number,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'user_id' => $user_id,
            'company_id' => $company_id,
        ]);

        return response()->json(['employee' => $employees, 'message' => 'Employee Created Successfully!'], 201);
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
