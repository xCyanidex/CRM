<?php

/**
 * DepartmentService Class
 *
 * Responsible for managing department-related operations.
 * Acts as an intermediary between controllers and the DepartmentRepository.
 */

namespace App\Services;

use App\Repositories\DepartmentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DepartmentService
{
    protected $departmentRepository;

    /**
     * Constructor for DepartmentService.
     *
     * @param DepartmentRepository $departmentRepository The repository for department-related database operations
     */
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Create a new department.
     *
     * @param array $data Data for creating the department
     * @return mixed Returns the created department or appropriate error response
     */
    public function createDepartment(array $data)
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if the user belongs to a company
        $company = $user->company;
        if (!$company) {
            return response()->json(['message' => 'User does not belong to a company'], 400);
        }

        // Get the company ID
        $company_id = $company->id;

        // Create the department using DepartmentRepository
        return $this->departmentRepository->createDepartment([
            'department_name' => $data['department_name'],
            'company_id' => $company_id,
        ]);
    }

    /**
     * Get all departments.
     *
     * @return mixed Returns all departments
     */
    public function getAllDepartments()
    {
        return $this->departmentRepository->getAllDepartments();
    }

    /**
     * Find a department by name.
     *
     * @param string $name The name of the department to find
     * @return mixed Returns the found department
     */
    public function findDepartmentByName($name)
    {
        return $this->departmentRepository->findDepartmentByName($name);
    }

    /**
     * Get a department by its ID.
     *
     * @param int $id The ID of the department to retrieve
     * @return mixed Returns the department with the given ID
     */
    public function getDepartment($id)
    {
        return $this->departmentRepository->getDepartmentById($id);
    }

    /**
     * Update a department.
     *
     * @param int $id The ID of the department to update
     * @param array $data Data for updating the department
     * @return mixed Returns the updated department or appropriate error response
     */
    public function updateDepartment($id, array $data)
    {
        return $this->departmentRepository->updateDepartment($id, $data);
    }

    /**
     * Delete a department.
     *
     * @param int $id The ID of the department to delete
     * @return mixed Returns the deletion status or appropriate error response
     */
    public function deleteDepartment($id)
    {
        return $this->departmentRepository->deleteDepartment($id);
    }

    /**
     * Find a department associated with a user.
     *
     * @param mixed $user The user object
     * @return mixed Returns the department associated with the user or appropriate error response
     */
    public function findDepartmentByUser($user)
    {
        $company = $user->company;
        if ($company) {
            // Fetch the department based on the company or any other criteria
            $department = $company->departments()->first(); // Example logic, adjust according to your structure
            return $department;
        }

        return response()->json(['message' => 'Department for the user not found!']);
    }
}
