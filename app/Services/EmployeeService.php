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

    public function create(array $data)
    {
        return $this->employeeRepository->createEmployee($data);
    }

    public function getAllEmployees()
        {
            return $this->employeeRepository->getAllEmployees();
        }

    public function getEmployeeById($id)
    {
        return $this->employeeRepository->getEmployeeById($id);
    }

    public function updateEmployee($id, array $data)
        {
            $employee = $this->getEmployeeById($id);

            if ($employee) {
                return $this->employeeRepository->updateEmployee($id, $data);
            }
        
            return null;
        }

    public function deleteEmployee($employee)
        {
            return $this->employeeRepository->deleteEmployee($employee);
        }    

    // Add other methods as needed for employees
}

