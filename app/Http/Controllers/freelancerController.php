<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Freelancers;

class freelancerController extends Controller
{
    public function getAll(){
            $freelancer = Freelancers::all();
            return response()->json(['freelancers' => $freelancer], 200);
        }

    
    public function show($id){ 
        $freelancer = Freelancers::find($id);
        if(!$freelancer){
            return response()->json(['message'=>'freelancer not found'],404);
        }
        return response()->json(['freelancers'=>$freelancer],200);
    }
    public function update(Request $request,$id){
        $freelancer= Freelancers::find($id);
        if(!$freelancer){
            return response()->json(['message'=>'freelancer not found'],404);
        }else{
            $request->validate([
                'freelancer_name'=> 'required',
                'industry'=>'required',
            ]);
        }
        $freelancer->update($request->all());
    }

    public function destroy($id){
        $freelancer = Freelancers::find($id);
        if(!$freelancer){
            return response()->json(['message'=>'freelancer not found'],404);
        }else{
            $freelancer->delete();
            return response()->json(['message'=>'freelancer deleted successfully']);
        }
    }
}




