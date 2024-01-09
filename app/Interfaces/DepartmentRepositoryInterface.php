<?php

namespace App\Interfaces;

/**
 * Interface DepartmentRepositoryInterface
 * 
 * This interface defines methods for interacting with department data.
 */
interface DepartmentRepositoryInterface
{
    /**
     * Create a new department.
     *
     * @param array $data The department data.
     */
    public function createDepartment(array $data);

    /**
     * Get all departments.
     *
     */
    public function getAllDepartments();

    /**
     * Get a department by its ID.
     *
     * @param id $id The department ID.
     */
    public function getDepartmentById($id);

    /**
     * Find a department by its name.
     *
     * @param string $name The department name.
     */
    public function findDepartmentByName($name);

    /**
     * Update a department.
     *
     * @param int $id The department ID.
     * @param array $data The updated department data.
     */
    public function updateDepartment($id, array $data);

    /**
     * Delete a department by its ID.
     *
     * @param int $id The department ID.
     */
    public function deleteDepartment($id);
}
