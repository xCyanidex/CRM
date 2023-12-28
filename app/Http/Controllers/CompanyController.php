<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function getAllCompanies()
    {
        try {
            $companies = $this->companyService->getAllCompanies();
            return response()->json(['message' => 'Companies Fetched Successfully!', 'Companies' => $companies], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Company not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateCompany(Request $request, $id)
    {
        try {
            $updatedCompany = $this->companyService->updateCompany($request->all(), $id);
            return response()->json(['message' => 'Company Updated Successfully!', 'Company' => $updatedCompany], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Company not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteCompany($id)
    {
        try {
            $this->companyService->deleteCompany($id);
            return response()->json(['message' => 'Company Deleted Successfully!'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Company not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getCompany($id)
    {
        $company = $this->companyService->getCompany($id);
        if (!$company) {
            return response()->json(['message' => 'company not found'], 404);
        } else {

            return response()->json(['Company' => $company], 200);
        }
    }
}
