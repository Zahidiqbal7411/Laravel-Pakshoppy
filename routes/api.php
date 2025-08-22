<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VerificationController; // 👈 Add this line

// 🔓 Public routes (no auth needed)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ✅ Email verification via token (public, no auth)
Route::get('/verify-email', [VerificationController::class, 'verifyEmail']);

// ✅ Phone verification (OPTIONAL: make public if done before login)
Route::post('/verify-otp', [VerificationController::class, 'verifyPhoneOtp']);

// 🔐 Protected routes (require auth:sanctum)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // ✅ Authenticated user can request email verification
    Route::post('/send-email-verification', [VerificationController::class, 'sendEmailVerification']);

    // ✅ Authenticated user can request OTP
    Route::post('/send-otp', [VerificationController::class, 'sendPhoneOtp']);
});
