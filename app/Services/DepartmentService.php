<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DepartmentService
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function createDepartment(array $data)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $company = $user->company;
        if (!$company) {
        return response()->json(['message' => 'User does not belong to a company'], 400);
        }

        $company_id = $company->id;

        return $this->departmentRepository->createDepartment([
            'department_name' => $data['department_name'],
            'company_id' => $company_id,
        ]);
    }

    public function getAllDepartments()
    {
        return $this->departmentRepository->getAllDepartments();
    }

    public function findDepartmentByName($name)
    {
        
        return $this->departmentRepository->findDepartmentByName($name);
    }

    public function getDepartment($id)
    {
        return $this->departmentRepository->getDepartmentById($id);
    }

    public function updateDepartment($id, array $data)
    {
        return $this->departmentRepository->updateDepartment($id, $data);
    }

    public function deleteDepartment($id)
    {
        return $this->departmentRepository->deleteDepartment($id);
    }

    public function findDepartmentByUser($user)
    {
        $company = $user->company;
        if ($company) {
            // Fetch the department based on the company or any other criteria
            $department = $company->departments()->first(); // Example logic, adjust according to your structure
            return $department;
        }
    
        return response()->json(['message'=>'Department for the user not found!']);
    }
}
