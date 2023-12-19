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

    public function getAllUsers()
    {
        $users = User::all();
        return response()->json($users);
    }



    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ];

        $incomingReq = Validator::make($request->all(), $rules);

        if ($incomingReq->fails()) {
            return response()
                ->json(['message' => 'Invalid Input', 'Error' => $incomingReq->errors()], 422);
        }

        $validatedData = $incomingReq->validated();


        //Creating a user

        $user =  User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        $otp = rand(100000, 999999);

               // Save OTP to the user
                     $user->otp = $otp;
                     $user->save();

               // Send OTP in the verification email
               Mail::to($user)->send(new VerifyEmail($user, $otp));

        //Assigning a Token

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['message' => 'User Created Successfully and email was sent', 'token'=>$token], 201);
    }



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


    public function registerCompany(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string',
            'business_type' => 'required|string',
            'industry' => 'required|string',
            'registration_number' => 'required',
            'website' => 'nullable|url',
            'logo' => 'nullable|string',
        ]);
    
        // Authenticate the user using the provided token in the Authorization header
        $user = Auth::user();
        \Log::info('User ID: ' . $user->id);
        // var_dump($user->id);
    
        // Create and associate the company with the authenticated user
        $company = $user->company()->create([
            'company_name' => $request->input('company_name'),
            'business_type' => $request->input('business_type'),
            'industry' => $request->input('industry'),
            'registration_number' => $request->input('registration_number'),
            'website' => $request->input('website'),
            'logo' => $request->input('logo'),
            'user_id' => $user->id
        ]);

        // $user->company()->save($company);

        // Assign the company ID to the user
        $user->company_id = $company->id;
        $user->save();
    
        return response()->json(['message' => 'Company registered successfully', 'company' => $company], 201);
    }
    
    public function registerFreelancer(Request $request)
    {
        $request->validate([
            'freelancer_name' => 'string|required',
            'industry' => 'string|required'

        ]);

        if (!$user = Auth::user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // $user = Auth::user();

        $freelancer = Freelancers::create([
            'freelancer_name' => $request->input('freelancer_name'),
            'industry' => $request->input('industry'),
            'user_id' => $user->id
        ]);

        return response()->json(['message' => 'Freelancer Created Successfully']);
    }
}
