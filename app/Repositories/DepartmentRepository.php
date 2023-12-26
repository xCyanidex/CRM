<?php

namespace App\Repositories;

use App\Models\Department;

use App\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    protected $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function createDepartment(array $data)
    {
        return $this->department->create($data);
    }

    public function getAllDepartments()
        {
          
                return $this->department->all();
           
        }

        public function getDepartmentById($id)
        {
            return $this->department->find($id);
        }    

    public function updateDepartment($id, array $data)
    {
        $department = $this->department->find($id);

        if ($department) {
            $department->update($data);
            return $department;
        }
    }

    public function deleteDepartment($department)
    {
        return $department->delete();
    }

    

    // Add more specific methods as needed for the Department model
}
