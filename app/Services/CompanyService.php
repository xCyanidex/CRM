<?php

/**
 * CompanyService
 * 
 * This service class encapsulates business logic related to company operations.
 * It acts as an intermediary between the CompanyController and the underlying data layer,
 * utilizing the CompanyRepository for database interactions.
 *
 *
 * @category Service
 * @package  App\Services
 */

// Import necessary classes and namespaces
use App\Repositories\CompanyRepository;

class CompanyService
{
    // Instance of the CompanyRepository for database interactions
    protected $companyRepository;

    /**
     * Constructor
     *
     * @param  CompanyRepository  $companyRepository  The repository handling database operations for companies
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Create a new company
     *
     * @param  array  $data  Data for creating a new company
     */
    public function createCompany(array $data)
    {
        return $this->companyRepository->createCompany($data);
    }

    /**
     * Get a company by its ID
     *
     * @param  int  $id ID of the company
     */
    public function getCompany($id)
    {
        return $this->companyRepository->findCompanyById($id);
    }

    /**
     * Get all companies
     *
     */
    public function getAllCompanies()
    {
        return $this->companyRepository->getAllCompanies();
    }

    /**
     * Update a company by ID
     *
     * @param  array  $data  Data for updating the company
     * @param  int  $id  ID of the company to update
     */
    public function updateCompany(array $data, $id)
    {
        return $this->companyRepository->updateCompany($id, $data);
    }

    /**
     * Delete a company by ID
     *
     * @param  int  $id  ID of the company to delete
     */
    public function deleteCompany($id)
    {
        return $this->companyRepository->deleteCompany($id);
    }

    // Add other methods as needed for companies
}
