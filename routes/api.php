<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::get('/users', [AuthController::class,'getAllUsers']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/register/freelancer', [AuthController::class, 'registerFreelancer']);

// User Management (CRUD)

Route::get('/get-all-users', [UserController::class, 'index']);
Route::get('/get-user/{id}', [UserController::class, 'show']);
Route::put('/update-user/{id}', [UserController::class, 'update']);
Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);

// Company Management (CRUD)

Route::middleware('auth:sanctum')->post('/register/company', [AuthController::class, 'registerCompany']);
Route::get('/companies', [CompanyController::class, 'getAllCompanies']);
Route::put('/company/{id}', [CompanyController::class, 'updateCompany']);
Route::delete('/company/{id}', [CompanyController::class, 'deleteCompany']);
