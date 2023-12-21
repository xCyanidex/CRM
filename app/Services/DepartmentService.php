<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function create(array $data)
    {
        return $this->departmentRepository->create($data);
    }

    public function findById($id)
    {
        return $this->departmentRepository->findById($id);
    }

    // Add other methods as needed for departments
}
