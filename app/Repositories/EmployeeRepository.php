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

    public function update(Employee $employee, array $data)
    {
        return $employee->update($data);
    }

    public function delete(Employee $employee)
    {
        return $employee->delete();
    }

    public function findById($id)
    {
        return $this->employee->find($id);
    }

    // Add more specific methods as needed for the Employee model
}
