<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/katalog', function () {
    return "Halaman Katalog Produk";
})->name('katalog');

Route::get('/penjualan', function () {
    return "Halaman Penjualan";
})->name('penjualan');

Route::get('/katalog', [ProdukController::class, 'index'])->name('katalog');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.tambah_produk');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])
    ->name('produk.destroy');
Route::put('/produk/{id}', [ProdukController::class, 'update'])
    ->name('produk.update');

Route::get('/katalog', [ProdukController::class, 'katalog'])->name('katalog');
