<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\freelancerController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Requests\UserRegistrationRequest;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Routes for Authentication Management
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


// Routes for Freelancer Management
Route::get('/get-all-freelancers', [freelancerController::class, 'getAll']);
Route::get('/get-freelancer/{id}', [freelancerController::class, 'show']);
Route::put('/update-freelancer/{id}', [freelancerController::class, 'update']);
Route::delete('/delete-freelancer/{id}', [freelancerController::class, 'destroy']);

// Routes for User Management
// Route::post('/create-user', [UserController::class, 'createUser']);
Route::middleware('auth:sanctum')->get('/get-all-users', [UserController::class, 'getAllUsers']);
Route::middleware('auth:sanctum')->get('/get-user/{id}', [UserController::class, 'getUser']);
Route::middleware('auth:sanctum')->put('/update-user/{id}', [UserController::class, 'updateUser']);
Route::middleware('auth:sanctum')->delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

// Routes for Company Management
Route::get('/get-all-companies', [CompanyController::class, 'getAllCompanies']);
Route::put('/update-company/{id}', [CompanyController::class, 'updateCompany']);
Route::put('/get-company/{id}', [CompanyController::class, 'getCompany']);
Route::delete('/delete-company/{id}', [CompanyController::class, 'deleteCompany']);

// Routes for Department Management
Route::middleware('auth:sanctum')->post('/create-department', [DepartmentController::class, 'createDepartment']);
Route::get('/get-all-departments', [DepartmentController::class, 'getAllDepartments']);
Route::post('department/{name}', [DepartmentController::class, 'show']);
Route::put('/update-department/{id}', [DepartmentController::class, 'updateDepartment']);
Route::delete('/delete-department/{id}', [DepartmentController::class, 'deleteDepartment']);

// Routes for Employee Management
Route::prefix('employees')->middleware('auth:sanctum')->group(function () {
    Route::get('/get-all', [EmployeeController::class, 'index']);
    Route::post('/create', [EmployeeController::class, 'store']);
    Route::post('/update/{id}', [EmployeeController::class, 'update']);
    Route::delete('/delete/{id}', [EmployeeController::class, 'destroy']);
    Route::get('/get-user/{id}', [EmployeeController::class, 'show']);
});



// // Routes for Product Owner Management
// Route::get('/create-product-owner', [ProductOwnerController::class, 'store']);
// Route::get('/get-all-product-owners', [ProductOwnerController::class, 'index']);
// Route::get('/get-product-owner/{id}', [ProductOwnerController::class, 'show']);
// Route::put('/update-product-owner/{id}', [ProductOwnerController::class, 'update']);
// Route::delete('/delete-product-owner/{id}', [ProductOwnerController::class, 'destroy']);
//verify OTP

Route::middleware('auth:sanctum')->post('/email-verify', [EmailVerificationController::class, 'verify']);
Route::middleware(['auth:sanctum', 'verifyOTP'])->get('/home', function () {
    return response()->json(['message' => 'Welcome']);
});
