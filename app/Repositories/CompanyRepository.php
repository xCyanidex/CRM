<?php

namespace App\Repositories;

use App\Models\Company;
use App\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function createCompany(array $data)
    {
        return $this->company->create($data);
    }

    public function getAllCompanies()
    {
        return $this->company->all();
    }

    public function updateCompany($id, array $data)
    {
        return $this->company->findOrFail($id)->update($data);
    }

    public function deleteCompany($id)
    {
        return $this->company->findOrFail($id)->delete();
    }


    public function findCompanyById($id)
    {
        return $this->company->findOrFail($id);
    }

    // Add more specific methods as needed for the Company model
}
