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
        return $this->department->findOrFail($id);
    }    

    public function updateDepartment($id, array $data)
    {
        return $this->department->findOrFail($id)->update($data);
    }

    public function deleteDepartment($id)
    {
        return $this->department->findOrFail($id)->delete();
    }

    public function findDepartmentByName($name)
    {
        return $this->department->where('department_name', $name)->first();
    }

    

    // Add more specific methods as needed for the Department model
}
