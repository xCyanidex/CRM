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
        return $this->employeeRepository->create($data);
    }

    public function findById($id)
    {
        return $this->employeeRepository->findById($id);
    }

    // Add other methods as needed for employees
}

