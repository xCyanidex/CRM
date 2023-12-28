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

    public function getCompany($id)
    {
        return $this->companyRepository->findCompanyById($id);
    }

    public function getAllCompanies()
    {
        return $this->companyRepository->getAllCompanies();
    }

    public function updateCompany(array $data, $id)
    {
        return $this->companyRepository->updateCompany($id, $data);
    }

    public function deleteCompany($id)
    {
        return $this->companyRepository->deleteCompany($id);
    }

    // Add other methods as needed for companies
}
