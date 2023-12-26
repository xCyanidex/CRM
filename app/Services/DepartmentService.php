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

    public function getAllDepartments()
        {
          
         return   $this->departmentRepository->getAllDepartments();
   
        }


    public function getDepartmentById($id)
        {
            return $this->departmentRepository->getDepartmentById($id);
        }    
   
    public function updateDepartment($id, array $data)
        {
            $department = $this->getDepartmentById($id);

            if ($department) {
                return $this->departmentRepository->updateDepartment($id, $data);
            }
        
            return null;
        }
    
        public function deleteDepartment($department)
            {
                return $this->departmentRepository->deleteDepartment($department);
            }
}
