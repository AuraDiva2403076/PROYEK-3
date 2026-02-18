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

