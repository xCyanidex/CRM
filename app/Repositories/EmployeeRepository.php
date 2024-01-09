<?php

/**
 * Class EmployeeRepository
 * 
 * This class acts as an intermediary between the application's business logic
 * related to employees and the database. It encapsulates all database
 * operations for the Employee model.
 * 
 * Responsibilities:
 * - Creating, retrieving, updating, and deleting employees in the database.
 * - Provides methods to fetch employees and perform CRUD operations.
 * 
 * Usage:
 * The methods within this class can be utilized across the application to handle
 * employee-related database interactions, adhering to the defined interface.
 */

namespace App\Repositories;

use App\Models\Employee;
use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * The Employee model instance.
     *
     * @var Employee
     */
    protected $employee;

    /**
     * EmployeeRepository constructor.
     *
     * @param Employee $employee
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Create a new employee.
     *
     * @param array $data The data for creating the employee.
     * @return mixed The created employee instance.
     */
    public function createEmployee(array $data)
    {
        return $this->employee->create($data);
    }

    /**
     * Update an employee by ID.
     *
     * @param int $id The employee ID.
     * @param array $data The data for updating the employee.
     * @return mixed The updated employee instance.
     */
    public function updateEmployee($id, array $data)
    {
        return $this->employee->findOrFail($id)->update($data);
    }

    /**
     * Get all employees.
     *
     * @return mixed All employee instances.
     */
    public function getAllEmployees()
    {
        return $this->employee->all();
    }

    /**
     * Get an employee by ID.
     *
     * @param int $id The employee ID.
     * @return mixed The employee instance.
     */
    public function getEmployeeById($id)
    {
        return $this->employee->findOrFail($id);
    }

    /**
     * Delete an employee by ID.
     *
     * @param int $id The employee ID.
     * @return bool True if successful deletion, otherwise false.
     */
    public function deleteEmployee($id)
    {
        return $this->employee->findOrFail($id)->delete();
    }

    // Add more specific methods as needed for the Employee model
}
