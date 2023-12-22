<?php

namespace App\Http\Controllers;

use App\Services\FreelancerService;
use Illuminate\Http\Request;
use App\Models\Freelancer;

class freelancerController extends Controller
{
    protected $freelancerService;

    public function __construct(FreelancerService $freelancerService)
        {   
            $this->freelancerService = $freelancerService;
          
        }

    public function getAll(){
            
        $freelancer = $this->freelancerService->index();
        if(!$freelancer)
        {
            return response()->json(['message'=>'No Freelancer Found in DataBase'],404);
        }else{
            return response()->json(['Freelancers'=> $freelancer],200);
        }
            
        }

    
    public function show($id){ 
        $freelancer = $this->freelancerService->findById($id);
        if(!$freelancer){
            return response()->json(['message'=>'freelancer not found'],404);
        }
        return response()->json(['freelancers'=>$freelancer],200);
    }

    
    public function update(Request $request,$id){

        $freelancer= $this->freelancerService->findById($id);

        if(!$freelancer){
            return response()->json(['message'=>'freelancer not found'],404);
        }else{
            $data = $request->all();
            $this->freelancerService->update($freelancer, $data);
           
        }
       return response()->json(['message'=> 'Freelancer updated', ],200);
    }

    public function destroy($id){
        $freelancer = $this->freelancerService->findById($id);
        if(!$freelancer){
            return response()->json(['message'=>'freelancer not found'],404);
        }else{
            
           $this->freelancerService->deleteFreelancer($freelancer);
        }
        return response()->json(['message'=>'freelancer deleted successfully']);
    }
}




