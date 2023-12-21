<?php

namespace App\Interfaces;

interface DepartmentRepositoryInterface
{
    public function createDepartment(array $data);
    public function getAllDepartments();
    public function getDepartmentById($id);
    public function updateDepartment($id, array $data);
    public function deleteDepartment($id);
    public function findByEmail($email);
}
