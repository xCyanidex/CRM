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

    public function create(array $data)
    {
        return $this->department->create($data);
    }

    public function update(Department $department, array $data)
    {
        return $department->update($data);
    }

    public function delete(Department $department)
    {
        return $department->delete();
    }

    public function findById($id)
    {
        return $this->department->find($id);
    }

    // Add more specific methods as needed for the Department model
}
