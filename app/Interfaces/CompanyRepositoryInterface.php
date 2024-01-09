<?php

/**
 * CompanyRepositoryInterface
 * 
 * This interface defines the contract for repository classes that handle database operations
 * related to the Company model. Classes implementing this interface are expected to provide
 * implementations for methods such as creating, retrieving, updating, and deleting companies.
 *
 * @category Interface
 * @package  App\Interfaces
 */

namespace App\Interfaces;

interface CompanyRepositoryInterface
{
    /**
     * Create a new company
     *
     * @param  array  $data  Data for creating a new company
     */
    public function createCompany(array $data);

    /**
     *  Get all companies
     */
    public function getAllCompanies();

    /**
     * Find a company by its ID
     *
     * @param  int  $id  ID of the company to find
     */
    public function findCompanyById($id);

    /**
     * Update a company by ID
     *
     * @param  int  $id  ID of the company to update
     * @param  array  $data  Data for updating the company
     */
    public function updateCompany($id, array $data);

    /**
     * Delete a company by ID
     *
     * @param  int  $id  ID of the company to delete
     */
    public function deleteCompany($id);
}
