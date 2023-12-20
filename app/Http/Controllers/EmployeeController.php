<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();

        if (!$this->user) {
            return response()->json(['error' => 'User not Authorized.'], 400);
        }
    }
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
        $user_id = $this->user->id;
        $user = $this->user;

        $company_id = Company::where('user_id', $user_id)->value('id');

        $department_id = $user->company->departments()->value('id');

        if (!$company_id) {
            return response()->json(['error' => 'Company ID not found for the user'], 400);
        }

        if ($department_id === null) {
            return response()->json(['error' => 'Department ID not found for the company'], 400);
        }


        $request->validate([
            'email' => 'required',
            'password' => 'password',
            'employee_name' => 'required|string',
            'phone_number' => 'required',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            // 'user_id' => 'required|integer',
            // 'company_id' => 'required|integer',
        ]);

        $employees = Employees::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'employee_name' => $request->employee_name,
            'phone_number' => $request->phone_number,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'company_id' => $company_id,
            'department_id' => $department_id,
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
