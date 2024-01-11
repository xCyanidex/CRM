<?php

/**
 * EmployeeService Class
 *
 * Responsible for managing employee-related operations.
 * Acts as an intermediary between controllers and the EmployeeRepository.
 */

namespace App\Services;

use App\Repositories\EmployeeRepository;

class EmployeeService
{
    protected $employeeRepository;

    /**
     * Constructor for EmployeeService.
     *
     * @param EmployeeRepository $employeeRepository The repository for employee-related database operations
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Create a new employee.
     *
     * @param array $data Data for creating the employee
     * @return mixed Returns the created employee or appropriate error response
     */
    public function createEmployee(array $data)
    {
        return $this->employeeRepository->createEmployee($data);
    }

    /**
     * Get all employees.
     *
     * @return mixed Returns all employees
     */
    public function getAllEmployees()
    {
        return $this->employeeRepository->getAllEmployees();
    }

    /**
     * Get an employee by their ID.
     *
     * @param int $id The ID of the employee to retrieve
     * @return mixed Returns the employee with the given ID
     */
    public function getEmployee($id)
    {
        return $this->employeeRepository->getEmployeeById($id);
    }

    /**
     * Update an employee.
     *
     * @param int $id The ID of the employee to update
     * @param array $data Data for updating the employee
     * @return mixed Returns the updated employee or appropriate error response
     */
    public function updateEmployee($id, array $data)
    {
        return $this->employeeRepository->updateEmployee($id, $data);
    }

    /**
     * Delete an employee.
     *
     * @param int $id The ID of the employee to delete
     * @return mixed Returns the deletion status or appropriate error response
     */
    public function deleteEmployee($id)
    {
        return $this->employeeRepository->deleteEmployee($id);
    }

}
