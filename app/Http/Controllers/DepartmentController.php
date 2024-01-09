<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DepartmentService;
use Illuminate\Support\Facades\Auth;

/**
 * Controller managing department-related operations.
 * Handles creating, retrieving, updating, and deleting departments.
 * 
*/
class DepartmentController extends Controller
{
    // Instance of DepartmentService for handling department-related operations
    protected $departmentService;

    /**
     * Constructor to inject the DepartmentService.
     *
     * @param DepartmentService 
     */
    public function __construct(DepartmentService $departmentService) 
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Create a new department.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDepartment(Request $request)
    {
        // Try creating a new department
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

    /**
     * Get all departments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllDepartments()
    {
        // Try fetching all departments
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

    /**
     * Find a department by name.
     *
     * @param string $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function findDepartmentByName($name)
    {    
        // Try finding a department by name
        try {
            $department = $this->departmentService->findDepartmentByName($name);
            return response()->json(['message' => 'Department Fetched Successfully!', 'Department' => $department], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Department not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show a department by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Try showing a department by ID
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

    /**
     * Update a department by ID.
     *
     * @param int     $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDepartment($id, Request $request)
    {
        // Try updating a department by ID
        try {
            $updatedDepartment = $this->departmentService->updateDepartment($id, $request->all());
            return response()->json(['message' => 'Department Updated Successfully!', 'Department' => $updatedDepartment], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Department not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a department by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDepartment($id)
    {
        // Try deleting a department by ID
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
