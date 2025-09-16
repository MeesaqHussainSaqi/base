<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Sanctum\PersonalAccessToken;

// Route::post('/login', function () {
//     return "OKKKK";
// });

Route::post('/login', [AuthController::class, 'login']);

// Route::get('/users', [AuthController::class, 'GetAll']);
// Route::get('/debug-token', function () {
//     $token = request()->bearerToken();

//     $record = PersonalAccessToken::findToken($token);

//     if (! $record) {
//         return response()->json(['error' => 'Token not found']);
//     }

//     return response()->json([
//         'token_id' => $record->id,
//         'user_id' => $record->tokenable_id,
//     ]);
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/users')->group(function () {
        Route::post('/register', [AuthController::class, 'create']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('', [AuthController::class, 'GetAll']);
        Route::get('/{id}', [AuthController::class, 'show']);
        Route::put('/{id}', [AuthController::class, 'update']);
        Route::delete('/{id}', [AuthController::class, 'destroy']);
    });
});