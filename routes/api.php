<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PenjualanApiController;

Route::get('/produk', [ProdukApiController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::post('/google-login', [AuthController::class, 'googleLogin']);

Route::post('/resend-otp', [AuthController::class, 'resendOtp']);

Route::get('/check-user/{id}', [AuthController::class, 'checkUser']);

Route::post('/penjualan', [PenjualanApiController::class, 'store']);

