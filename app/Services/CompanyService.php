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
        return $this->companyRepository->create($data);
    }

    public function findById($id)
    {
        return $this->companyRepository->findById($id);
    }

    // Add other methods as needed for companies
}
