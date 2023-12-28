<?php

namespace App\Interfaces;

interface CompanyRepositoryInterface
{
    public function createCompany(array $data);
    public function getAllCompanies();
    public function findCompanyById($id);
    public function updateCompany($id, array $data);
    public function deleteCompany($id);
}
