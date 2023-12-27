<?php

namespace App\Repositories;

use App\Models\Employee;

use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function createEmployee(array $data)
    {
        return $this->employee->create($data);
    }

    public function updateEmployee($id, array $data)
    {
        return $this->employee->findOrFail($id)->update($data);
    }

    public function getAllEmployees()
    {
        return $this->employee->all();
    }

    public function getEmployeeById($id)
    {
        return $this->employee->findOrFail($id);
    }

    public function deleteEmployee($id)
    {
        return $this->employee->findOrFail($id)->delete();
    }

    // Add more specific methods as needed for the Employee model
}
