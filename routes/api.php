<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\freelancerController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
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


// Routes for Authentication Management
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/email-verify', [AuthController::class, 'verify']);
Route::middleware(['auth:sanctum', 'verifyOTP'])->get('/home', function () {
    return response()->json(['message' => 'Welcome']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);



// Routes for Freelancer Management
//  with middleware for Sanctum authentication and a specific role requirement.

Route::middleware(['auth:sanctum', 'role:product-owner'])->group(function () {

    // Route to get all freelancers, requires authentication and product-owner role.
    Route::get('/get-all-freelancers', [FreelancerController::class, 'getAll']);

    // Route to get a specific freelancer by ID, requires authentication and product-owner role.
    Route::get('/get-freelancer/{id}', [FreelancerController::class, 'show']);

    // Route to update a freelancer by ID, requires authentication and product-owner role.
    Route::put('/update-freelancer/{id}', [FreelancerController::class, 'update']);

    // Route to delete a freelancer by ID, requires authentication and product-owner role.
    Route::delete('/delete-freelancer/{id}', [FreelancerController::class, 'destroy']);
});


// Routes for User Management
Route::middleware(['auth:sanctum', 'role:product-owner'])->group(function (){
    Route::middleware('auth:sanctum')->get('/get-all-users', [UserController::class, 'getAllUsers']);
    Route::middleware('auth:sanctum')->get('/get-user/{id}', [UserController::class, 'getUser']);
    Route::middleware('auth:sanctum')->put('/update-user/{id}', [UserController::class, 'updateUser']);
    Route::middleware('auth:sanctum')->delete('/delete-user/{id}', [UserController::class, 'deleteUser']);
});


//  Routes for Company Management 
// routes with middleware for Sanctum authentication and a specific role requirement.

Route::middleware(['auth:sanctum', 'role:product-owner'])->group(function () {

    // Route to get all companies, requires authentication.
    Route::middleware('auth:sanctum')->get('/get-all-companies', [CompanyController::class, 'getAllCompanies']);

    // Route to update a company by ID, requires authentication.
    Route::middleware('auth:sanctum')->put('/update-company/{id}', [CompanyController::class, 'updateCompany']);

    // Route to get a specific company by ID, requires authentication.
    Route::middleware('auth:sanctum')->get('/get-company/{id}', [CompanyController::class, 'getCompany']);

    // Route to delete a company by ID, requires authentication.
    Route::middleware('auth:sanctum')->delete('/delete-company/{id}', [CompanyController::class, 'deleteCompany']);
});



// Routes for Department Management
Route::middleware(['auth:sanctum', 'role:company-admin'])->group(function (){
    Route::middleware('auth:sanctum')->post('/create-department', [DepartmentController::class, 'createDepartment']);
Route::middleware('auth:sanctum')->get('/get-all-departments', [DepartmentController::class, 'getAllDepartments']);
Route::middleware('auth:sanctum')->get('/get-department/{name}', [DepartmentController::class, 'findDepartmentByName']);
Route::middleware('auth:sanctum')->put('/update-department/{id}', [DepartmentController::class, 'updateDepartment']);
Route::middleware('auth:sanctum')->delete('/delete-department/{id}', [DepartmentController::class, 'deleteDepartment']);
});

// Routes for Employee Management
Route::middleware(['auth:sanctum', 'role:company-admin'])->group(function (){
    Route::prefix('employees')->middleware('auth:sanctum')->group(function () {
        Route::get('/get-all', [EmployeeController::class, 'getAllEmployees']);
        Route::post('/create', [EmployeeController::class, 'store']);   
        Route::post('/update/{id}', [EmployeeController::class, 'update']);
        Route::delete('/delete/{id}', [EmployeeController::class, 'destroy']);
        Route::get('/get-user/{id}', [EmployeeController::class, 'show']);
    });
});



/** Middleware group that applies 'auth:sanctum' and 'role:employee' 
 * middleware to all routes within the group.
 * 
 * POST route to create a new task, handled by the createTask method in TaskController.
 * GET route to retrieve all tasks, handled by the getAllTasks method in TaskController.
 * PUT route to update an existing task, handled by the updateTask method in TaskController.
 * DELETE route to delete a task, handled by the deleteTask method in TaskController.
 * POST route to assign a task, handled by the assignTask method in TaskController.
 */

Route::middleware(['auth:sanctum', 'role:employee'])->group(function (){
    Route::post('create-task',[TaskController::class,'createTask']);
    Route::get('show-task',[TaskController::class,'ShowTask']);
    Route::put('update-task/{id}',[TaskController::class,'updateTask']);
    Route::delete('delete-task/{id}',[TaskController::class,'deleteTask']);
    Route::post('assign-task',[TaskController::class,'assignTask']);
});



