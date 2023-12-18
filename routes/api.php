<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\freelancerController;

use App\Http\Controllers\ProductOwnerController;

use App\Http\Controllers\EmployeeController;
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

// Routes for Authentication Management
Route::post('/register', [AuthController::class, 'register']);
Route::get('/users', [AuthController::class,'getAllUsers']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/register/company', [AuthController::class, 'registerCompany']);
Route::middleware('auth:sanctum')->post('/register/freelancer', [AuthController::class, 'registerFreelancer']);

// Routes for Company Management
Route::get('/get-all-companies', [CompanyController::class, 'getAllCompanies']);
Route::put('/update-company/{id}', [CompanyController::class, 'updateCompany']);
Route::delete('/delete-company/{id}', [CompanyController::class, 'deleteCompany']);

Route::middleware('auth:sanctum')->post('/register/freelancer', [AuthController::class, 'registerFreelancer']);
// Routes for Freelancer Management
Route::get('/get-all-freelancers', [freelancerController::class, 'getAll']);
Route::get('/get-freelancer/{id}', [freelancerController::class, 'show']);
Route::put('/update-freelancer/{id}', [freelancerController::class, 'update']);
Route::delete('/delete-freelancer/{id}', [freelancerController::class, 'destroy']);

// Routes for User Management
Route::get('/get-all-users', [UserController::class, 'getAllUsers']);
Route::get('/get-user/{id}', [UserController::class, 'getUser']);
Route::put('/update-user/{id}', [UserController::class, 'updateUser']);
Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

// Routes for Product Owner Management
Route::get('/create-product-owner', [ProductOwnerController::class, 'store']);
Route::get('/get-all-product-owners', [ProductOwnerController::class, 'index']);
Route::get('/get-product-owner/{id}', [ProductOwnerController::class, 'show']);
Route::put('/update-product-owner/{id}', [ProductOwnerController::class, 'update']);
Route::delete('/delete-product-owner/{id}', [ProductOwnerController::class, 'destroy']);
Route::get('/users', [AuthController::class, 'getAllUsers']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/register/company', [AuthController::class, 'registerCompany']);
Route::get('/get-all-users', [UserController::class, 'index']);
Route::get('/get-user/{id}', [UserController::class, 'show']);
Route::put('/update-user/{id}', [UserController::class, 'update']);
Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);

// employye CRUD
Route::prefix('employees')->group(function () {
    Route::get('/get-all', [EmployeeController::class, 'index']);
    Route::post('/create', [EmployeeController::class, 'store']);
    Route::post('/update/{id}', [EmployeeController::class, 'update']);
    Route::delete('/delete/{id}', [EmployeeController::class, 'destroy']);
    Route::get('/get-user/{id}', [EmployeeController::class, 'show']);
});
