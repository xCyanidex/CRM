<?php

/**
 * Class DepartmentRepository
 * 
 * This class acts as an intermediary between the application's business logic
 * related to departments and the database. It encapsulates all database
 * operations for the Department model.
 * 
 * Responsibilities:
 * - Creating, retrieving, updating, and deleting departments in the database.
 * - Provides methods to fetch departments and perform CRUD operations.
 * 
 * Usage:
 * The methods within this class can be utilized across the application to handle
 * department-related database interactions, adhering to the defined interface.
 */

namespace App\Repositories;

use App\Models\Department;

use App\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    /**
     * The Department model instance.
     *
     * @var Department
     */
    protected $department;

    /**
     * DepartmentRepository constructor.
     *
     * @param Department $department
     */
    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    /**
     * Create a new department.
     *
     * @param array $data The data for creating the department.
     * @return mixed The created department instance.
     */
    public function createDepartment(array $data)
    {
        return $this->department->create($data);
    }

    /**
     * Get all departments.
     *
     * @return mixed All department instances.
     */
    public function getAllDepartments()
    {
        return $this->department->all();
    }

    /**
     * Get a department by ID.
     *
     * @param int $id The department ID.
     * @return mixed The department instance.
     */
    public function getDepartmentById($id)
    {
        return $this->department->findOrFail($id);
    }

    /**
     * Update a department by ID.
     *
     * @param int $id The department ID.
     * @param array $data The data for updating the department.
     * @return mixed The updated department instance.
     */
    public function updateDepartment($id, array $data)
    {
        return $this->department->findOrFail($id)->update($data);
    }

    /**
     * Delete a department by ID.
     *
     * @param int $id The department ID.
     * @return bool True if successful deletion, otherwise false.
     */
    public function deleteDepartment($id)
    {
        return $this->department->findOrFail($id)->delete();
    }

    /**
     * Find a department by name.
     *
     * @param string $name The department name to search for.
     * @return mixed The department instance if found, otherwise null.
     */
    public function findDepartmentByName($name)
    {
        return $this->department->where('department_name', $name)->first();
    }

    

}
