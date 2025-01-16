<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


// Rute untuk halaman admin
Route::get('/admins', [AdminController::class, 'showAdminsPage']);

// Rute untuk halaman data user
Route::get('/datauser', [UserController::class, 'showUsersPage']);


Route::post('login', [AuthController::class, 'login']); // Login endpoint


Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('{id}', [AdminController::class, 'show']);
    Route::post('/', [AdminController::class, 'store']);
    Route::put('{id}', [AdminController::class, 'update']);
});

Route::group(['middleware' => 'api', 'prefix' => 'admins'], function () {
    Route::get('/', [AdminController::class, 'index']); // List all Admins
    Route::post('/', [AdminController::class, 'store']); // Create new Admin
    Route::get('/{id}', [AdminController::class, 'show']); // Show Admin by ID
    Route::put('/{id}', [AdminController::class, 'update']); // Update Admin by ID
    Route::delete('/{id}', [AdminController::class, 'destroy']); // Delete Admin by ID
});

Route::group(['middleware' => 'api', 'prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']); // List all Users
    Route::post('/', [UserController::class, 'store']); // Create new User
    Route::get('/{id}', [UserController::class, 'show']); // Show User by ID
    Route::put('/{id}', [UserController::class, 'update']); // Update User by ID
    Route::delete('/{id}', [UserController::class, 'destroy']); // Delete User by ID
});

