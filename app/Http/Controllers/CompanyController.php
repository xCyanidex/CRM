<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{

    public function getAllCompanies()
        {
            $companies = Company::all();
            return response()->json([$companies]);
        }


    // public function createCompany(Request $request)
    //     {
            
    //     }    

    public function updateCompany(Request $request, $id)
        {
            $company = Company::findOrFail($id);
            $company->update($request->all());

            return response()->json(['message'=>'Company updated Successfully']);
        }

        public function deleteCompany($id)
        {
            try {
                $company = Company::findOrFail($id);
                $company->delete();
        
                return response()->json(['message' => 'Company deleted Successfully']);

            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return response()->json(['message' => 'Company not found'], 404);

            } catch (\Exception $e) {
                return response()->json(['message' => 'Error deleting company', 'error' => $e->getMessage()], 500);
            }
        }
          
}
