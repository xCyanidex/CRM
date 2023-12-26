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

    public function getAllEmployees()
        {
            return $this->employee->all();
        }

        public function getEmployeeById($id)
        {
            return $this->employee->find($id);
        }

    public function updateEmployee($id, array $data)
    {
        $employee = $this->employee->find($id);

        if ($employee) {
            $employee->update($data);
            return $employee;
        }
    }

    public function deleteEmployee($employee)
    {
        return $this->$employee->delete();
    }

  

    // Add more specific methods as needed for the Employee model
}
