<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductOwnerController;

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
// Route::get('/users', [AuthController::class,'getAllUsers']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/register/company', [AuthController::class, 'registerCompany']);

// Routes for User Management
Route::get('/get-all-users', [UserController::class, 'getAllUsers']);
Route::get('/get-user/{id}', [UserController::class, 'getUser']);
Route::put('/update-user/{id}', [UserController::class, 'updateUser']);
Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

// Routes for Product Owner Management
Route::get('/create-product-owner', [ProductController::class, 'store']);
Route::get('/get-all-product-owners', [ProductOwnerController::class, 'index']);
Route::get('/get-product-owner/{id}', [ProductOwnerController::class, 'show']);
Route::put('/update-product-owner/{id}', [ProductOwnerController::class, 'update']);
Route::delete('/delete-product-owner/{id}', [ProductOwnerController::class, 'destroy']);