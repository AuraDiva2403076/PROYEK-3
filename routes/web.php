<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DiscountController;



Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/dashboard/data', [DashboardController::class, 'data'])
    ->name('dashboard.data');


Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/katalog', [ProdukController::class, 'index'])->name('katalog');

Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.tambah_produk');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');

Route::get('/pengaturan', function () {
    return view('pengaturan');
})->name('pengaturan');

Route::get('/penjualan', [PenjualanController::class, 'index'])
    ->name('penjualan.index');

Route::get('/penjualan/{id}/edit', [PenjualanController::class, 'edit'])
    ->name('penjualan.edit');

Route::put('/penjualan/{id}', [PenjualanController::class, 'update'])
    ->name('penjualan.update');

Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])
    ->name('penjualan.destroy');

    
Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
Route::post('/pengguna/{id}/status', [PenggunaController::class, 'updateStatus'])
    ->name('pengguna.updateStatus');


// fitur Ai
Route::get('/dataset-ai', [RekomendasiController::class, 'index'])
    ->name('dataset-ai.index');

Route::delete('/dataset-ai/{id}', [RekomendasiController::class, 'destroy'])
    ->name('dataset-ai.destroy');
Route::get('/ai', function () {
    return redirect()->route('dataset-ai.index');
})->name('ai');
Route::post('/dataset-ai/predict', [RekomendasiController::class, 'predict'])->name('dataset-ai.predict');
Route::get('/dataset-ai/{id}/edit', [RekomendasiController::class, 'edit'])
    ->name('dataset-ai.edit');

Route::put('/dataset-ai/{id}', [RekomendasiController::class, 'update'])
    ->name('dataset-ai.update');

Route::prefix('laporan')->name('laporan.')->group(function () {
    // Laporan Penjualan
    Route::get('/penjualan', [PenjualanController::class, 'laporan'])
        ->name('penjualan');
    Route::get('/penjualan/export', [PenjualanController::class, 'export'])
        ->name('penjualan.export');

    // Laporan Produk
    Route::get('/produk', [ProdukController::class, 'laporanProduk'])
        ->name('produk');
    Route::get('/produk/export', [ProdukController::class, 'export'])
        ->name('produk.export');

    // Laporan Pengguna
    Route::get('/pengguna', [PenggunaController::class, 'laporanPengguna'])
        ->name('pengguna');
    Route::get('/pengguna/export', [PenggunaController::class, 'export'])
        ->name('pengguna.export');
});



Route::get('/produk-image/{filename}', [ImageController::class, 'show']);

// ======================
// DISCOUNT
// ======================

Route::resource('discount', DiscountController::class);

Route::patch('/discount/{id}/toggle',
    [DiscountController::class, 'toggle'])
    ->name('discount.toggle');

    

