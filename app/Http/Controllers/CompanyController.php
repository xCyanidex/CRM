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
        $companies = $this->companyService->getAllCompanies();

        if (!$companies) {
            return response()->json(['message' => 'No companies found'], 404);
        } else {
            return response()->json(['Companies' => $companies], 200);
        }
    }

    public function updateCompany(Request $request, $id)
    {

        $company = $this->companyService->findById($id);

        if (!$company) {
            return response()->json(['message' => 'company not found'], 404);
        } else {
            $data = $request->all();
            $this->companyService->updateCompany($company, $data);
        }


        return response()->json(['message' => 'Company updated',], 200);
    }

    public function deleteCompany($id)
    {

        $company = $this->companyService->findById($id);
        if (!$company) {
            return response()->json(['message' => 'company not found'], 404);
        } else {

            $this->companyService->deleteCompany($company);
        }
        return response()->json(['message' => 'company deleted successfully']);
    }

    public function getCompany($id)
    {
        $company = $this->companyService->findById($id);
        if (!$company) {
            return response()->json(['message' => 'company not found'], 404);
        } else {

            return response()->json(['Company' => $company], 200);
        }
    }
}
