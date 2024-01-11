<?php

namespace App\Interfaces;

/**
 * Interface EmployeeRepositoryInterface
 * 
 * This interface defines methods for interacting with employee data.
 */
interface EmployeeRepositoryInterface
{
    /**
     * Create a new employee.
     *
     * @param array $data The employee data.
     */
    public function createEmployee(array $data);

    /**
     * Get all employees.
     *
     * @return array
     */
    public function getAllEmployees();

    /**
     * Get an employee by their ID.
     *
     * @param int $id The employee ID.
     */
    public function getEmployeeById($id);

    /**
     * Update an employee.
     *
     * @param int $id The employee ID.
     * @param array $data The updated employee data.
     */
    public function updateEmployee($id, array $data);

    /**
     * Delete an employee by their ID.
     *
     * @param int $id The employee ID.
     */
    public function deleteEmployee($id);
}
