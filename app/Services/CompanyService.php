<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function createCompany(array $data)
    {
        return $this->companyRepository->createCompany($data);
    }

    public function findById($id)
    {
        return $this->companyRepository->findById($id);
    }

    public function getAllCompanies()
    {
        return $this->companyRepository->getAllCompanies();
    }

    public function updateCompany($id, array $data)
    {
        return $this->companyRepository->updateCompany($id, $data);
    }

    public function deleteCompany($id)
    {
        return $this->companyRepository->deleteCompany($id);
    }

    // Add other methods as needed for companies
}
