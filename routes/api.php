<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdukApiController;

Route::get('/produk', [ProdukApiController::class, 'index']);