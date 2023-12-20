<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;


use App\Models\User;
use App\Models\Company;
use App\Models\Freelancers;


class AuthController extends Controller
{



    public function register(Request $request)
    {

        // checking the user type

        if($request->input('userType') == 'company')
            {

                $rules = [
                    'username' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:8',
                    'company_name' => 'required|string',
                    'business_type' => 'required|string',
                    'industry' => 'required|string',
                    'registration_number' => 'required',
                    'website' => 'nullable|url',
                    'logo' => 'nullable|string',
                    'userType'=>'required|string'
                    
                ];
        
                $incomingReq = Validator::make($request->all(), $rules);
        
                if ($incomingReq->fails()) {
                    return response()
                        ->json(['message' => 'Invalid Input', 'Error' => $incomingReq->errors()], 422);
                }
        
                $validatedData = $incomingReq->validated();
    
                $user =  User::create([
                    'username' => $validatedData['username'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']),
                    'userType' => $validatedData['userType']
                ]);

                 // Create and associate the company with the authenticated user
                 
                 $company = $user->company()->create([
                 'company_name' => $validatedData['company_name'],
                 'business_type' => $validatedData['business_type'],
                 'industry' => $validatedData['industry'],
                 'registration_number' => $validatedData['registration_number'],
                  'website' => $validatedData['website'],
                  'logo' => $validatedData['logo'],
                  'user_id' => $user->id
                 ]);

                 var_dump($company);
                 
                 $user->company()->associate($company);
                 $user->save();


                 return response()->json(['message'=>'hello company']);


            }



            if($request->input('userType') == 'freelancer')
            {

                $rules = [
                    'username' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:8',
                    'freelancer_name' => 'string|required',
                    'industry' => 'string|required',
                    'userType'=>'required|string'
                    
                ];
        
                $incomingReq = Validator::make($request->all(), $rules);
        
                if ($incomingReq->fails()) {
                    return response()
                        ->json(['message' => 'Invalid Input', 'Error' => $incomingReq->errors()], 422);
                }
        
                $validatedData = $incomingReq->validated();
    
                $user =  User::create([
                    'username' => $validatedData['username'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']),
                    'userType' => $validatedData['userType']
                ]);

                 // Create and associate the company with the authenticated user
                 
                 $freelancer = Freelancers::create([
                    'freelancer_name' => $request->input('freelancer_name'),
                    'industry' => $request->input('industry'),
                    'user_id' => $user->id
                ]);

                
                 
                 $user->freelancer()->associate($freelancer);
                 $user->save();
                 

                 return response()->json(['message'=>'hello company']);


            }

        }// register


        //Creating a user

 

    //     $otp = rand(100000, 999999);

    //            // Save OTP to the user
    //                  $user->otp = $otp;
    //                  $user->save();

    //            // Send OTP in the verification email
    //            Mail::to($user)->send(new VerifyEmail($user, $otp));

    //     //Assigning a Token

    //     $token = $user->createToken('api-token')->plainTextToken;
    //     return response()->json(['message' => 'User Created Successfully and email was sent', 'token'=>$token], 201);
    // }



    public function login(Request $request)
    {
        $rules = [

            'email' => 'required|email|',
            'password' => 'required|min:8'
        ];

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json(['message' => 'Login successful', 'token' => $token], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }


    public function logout()
    {
        $user = Auth::user();

        // Revoke the user's current token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'User logged out successfully']);
    }



    
 
}
