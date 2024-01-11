<?php

/**
 * CompanyRepository
 * 
 * This repository class provides an abstraction for database operations related to the Company model.
 * It implements the CompanyRepositoryInterface and interacts with the underlying Company model.
 *
 *
 * @category Repository
 * @package  App\Repositories
 */

// Import necessary classes and namespaces
namespace App\Repositories;
use App\Models\Company;
use App\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    // Instance of the Company model
    protected $company;

    /**
     * Constructor
     *
     * @param  Company  $company  The Company model instance
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Create a new company
     *
     * @param  array  $data  Data for creating a new company
     */
    public function createCompany(array $data)
    {
        return $this->company->create($data);
    }

    /**
     * 
     * Get all companies
     *
     */
    public function getAllCompanies()
    {
        return $this->company->all();
    }

    /**
     * Update a company by ID
     *
     * @param  int  $id  ID of the company to update
     * @param  array  $data  Data for updating the company
     */
    public function updateCompany($id, array $data)
    {
        return $this->company->findOrFail($id)->update($data);
    }

    /**
     * Delete a company by ID
     *
     * @param  int  $id  ID of the company to delete
     */
    public function deleteCompany($id)
    {
        return $this->company->findOrFail($id)->delete();
    }

    /**
     * Find a company by its ID
     *
     * @param  int  $id  ID of the company to find
     */
    public function findCompanyById($id)
    {
        return $this->company->findOrFail($id);
    }

    // Add more specific methods as needed for the Company model
}
