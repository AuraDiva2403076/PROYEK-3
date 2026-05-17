<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DiscountApiController;

Route::get('/produk', [ProdukApiController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::get('/discounts', [DiscountApiController::class, 'index']);