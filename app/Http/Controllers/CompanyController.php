<?php

/**
 * CompanyController
 * 
 * This controller handles requests related to company operations, such as fetching all companies,
 * updating a specific company, deleting a company, and retrieving a single company by its ID.
 * It utilizes the CompanyService to interact with the underlying data layer.
 * 
 *
 * @category Controller
 * @package  App\Http\Controllers
 */

// Import necessary classes and namespaces

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CompanyService;
class CompanyController extends Controller
{
    // Inject CompanyService into the controller
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    // Get all companies
    public function getAllCompanies()
    {
        try {
            // Attempt to retrieve all companies through the CompanyService
            $companies = $this->companyService->getAllCompanies();
            
            // Return a JSON response with a success message and the fetched companies
            return response()->json(['message' => 'Companies Fetched Successfully!', 'Companies' => $companies], 200);
        } catch (\Exception $e) {
            // Handle the case where no companies are found
            return response()->json(['message' => 'Company not found'], 404);
        } catch (\Exception $e) {
            // Handle other exceptions with a generic error message
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    // Update a company by ID
    public function updateCompany(Request $request, $id)
    {
        try {
            // Attempt to update the company through the CompanyService using request data and company ID
            $updatedCompany = $this->companyService->updateCompany($request->all(), $id);
            
            // Return a JSON response with a success message and the updated company details
            return response()->json(['message' => 'Company Updated Successfully!', 'Company' => $updatedCompany], 200);
        } catch (\Exception $e) {
            // Handle the case where the company to update is not found
            return response()->json(['message' => 'Company not found'], 404);
        } catch (\Exception $e) {
            // Handle other exceptions with a generic error message
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    // Delete a company by ID
    public function deleteCompany($id)
    {
        try {
            // Attempt to delete the company through the CompanyService using company ID
            $this->companyService->deleteCompany($id);
            
            // Return a JSON response with a success message
            return response()->json(['message' => 'Company Deleted Successfully!'], 200);
        } catch (\Exception $e) {
            // Handle the case where the company to delete is not found
            return response()->json(['message' => 'Company not found'], 404);
        } catch (\Exception $e) {
            // Handle other exceptions with a generic error message
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    // Get a company by ID
    public function getCompany($id)
    {
        // Retrieve the company through the CompanyService using company ID
        $company = $this->companyService->getCompany($id);

        // Check if the company exists
        if (!$company) {
            // Return a JSON response with a not found message
            return response()->json(['message' => 'Company not found'], 404);
        } else {
            // Return a JSON response with the fetched company details
            return response()->json(['Company' => $company], 200);
        }
    }
}
