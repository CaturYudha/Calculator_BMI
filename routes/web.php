<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('adminlogin');
});

Route::get('/admins', [AdminController::class, 'showAdminsPage']);
Route::get('/datauser', [UserController::class, 'showUsersPage']);




    