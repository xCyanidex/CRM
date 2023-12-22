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

    public function createDepartment(array $data)
    {
        return $this->departmentRepository->createDepartment($data);
    }

    public function index()
        {
          
            $this->departmentRepository->getAllDepartments();
    
        }

    public function findByName($name)
    {   
        $id = 
         $this->departmentRepository->getDepartmentById($id);
    }

    // Add other methods as needed for departments
}
