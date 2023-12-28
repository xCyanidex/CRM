<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function createEmployee(array $data)
    {
        return $this->employeeRepository->createEmployee($data);
    }

    public function getAllEmployees()
    {
        return $this->employeeRepository->getAllEmployees();
    }

    public function getEmployee($id)
    {
        return $this->employeeRepository->getEmployeeById($id);
    }

    public function updateEmployee($id, array $data)
    {
        return $this->employeeRepository->updateEmployee($id, $data);
    }

    public function deleteEmployee($id)
    {
        return $this->employeeRepository->deleteEmployee($id);
    }
    // Add other methods as needed for employees
}

