<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RekomendasiController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/katalog', [ProdukController::class, 'index'])->name('katalog');

Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.tambah_produk');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');

Route::get('/pengaturan', function () {
    return view('pengaturan');
})->name('pengaturan');

Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
Route::patch('/pengguna/{id}/status', [PenggunaController::class, 'updateStatus'])
    ->name('pengguna.updateStatus');

    
