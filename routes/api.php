<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Laravel\Sanctum\PersonalAccessToken;

// Route::post('/login', function () {
//     return "OKKKK";
// });

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/users')->group(function () {
        Route::post('/register', [UserController::class, 'create']);
        Route::get('/profile', [UserController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('', [UserController::class, 'GetAll']);
        Route::get('/{id}', [UserController::class, 'GetById']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [AuthController::class, 'destroy']);
    });
});