<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PenjualanApiController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\Api\AnalisisApiController;
use App\Http\Controllers\Api\DiscountApiController;
use App\Http\Controllers\RekomendasiController;

Route::get('/produk', [ProdukApiController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::post('/google-login', [AuthController::class, 'googleLogin']);

Route::post('/resend-otp', [AuthController::class, 'resendOtp']);

Route::get('/check-user/{id}', [AuthController::class, 'checkUser']);

Route::post('/penjualan', [PenjualanApiController::class, 'store']);

Route::post('/update-profile', [PenggunaController::class, 'updateProfile']);

Route::post('/analisis', [AnalisisApiController::class, 'store']);
Route::get('/analisis/history/{user_id}', [AnalisisApiController::class, 'history']);

Route::delete('/analisis/{id}', [RekomendasiController::class, 'destroyAnalisis'])
    ->name('analisis.destroy');

Route::get('/discounts', [DiscountApiController::class, 'index']);
