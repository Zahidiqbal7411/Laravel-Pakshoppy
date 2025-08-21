<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController; // Don't forget to import your controller

// 🔐 Public routes
Route::post('api/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 🔐 Protected routes (require auth)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('api/user', [AuthController::class, 'user']);
    Route::post('api/logout', [AuthController::class, 'logout']);
});
