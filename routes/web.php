<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard/data', [DashboardController::class, 'data'])
    ->name('dashboard.data');

/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
*/
Route::get('/search', [SearchController::class, 'index'])
    ->name('search');

/*
|--------------------------------------------------------------------------
| Produk / Katalog
|--------------------------------------------------------------------------
*/
Route::get('/katalog', [ProdukController::class, 'index'])
    ->name('katalog');

Route::get('/produk/create', [ProdukController::class, 'create'])
    ->name('produk.tambah_produk');

Route::post('/produk/store', [ProdukController::class, 'store'])
    ->name('produk.store');

Route::put('/produk/{id}', [ProdukController::class, 'update'])
    ->name('produk.update');

Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])
    ->name('produk.destroy');

/*
|--------------------------------------------------------------------------
| Penjualan
|--------------------------------------------------------------------------
*/
Route::get('/penjualan', [PenjualanController::class, 'index'])
    ->name('penjualan');

/*
|--------------------------------------------------------------------------
| Pengguna
|--------------------------------------------------------------------------
*/
Route::get('/pengguna', [PenggunaController::class, 'index'])
    ->name('pengguna');

Route::patch('/pengguna/{id}/status', [PenggunaController::class, 'updateStatus'])
    ->name('pengguna.updateStatus');

/*
|--------------------------------------------------------------------------
| Pengaturan
|--------------------------------------------------------------------------
*/
Route::view('/pengaturan', 'pengaturan')
    ->name('pengaturan');

/*
|--------------------------------------------------------------------------
| AI / Rekomendasi
|--------------------------------------------------------------------------
*/
Route::prefix('dataset-ai')->name('dataset-ai.')->group(function () {

    Route::get('/', [RekomendasiController::class, 'index'])->name('index');
    Route::post('/predict', [RekomendasiController::class, 'predict'])->name('predict');

    Route::get('/{id}/edit', [RekomendasiController::class, 'edit'])->name('edit');
    Route::put('/{id}', [RekomendasiController::class, 'update'])->name('update');
    Route::delete('/{id}', [RekomendasiController::class, 'destroy'])->name('destroy');
});

Route::get('/ai', function () {
    return redirect()->route('dataset-ai.index');
})->name('ai');

/*
|--------------------------------------------------------------------------
| Laporan
|--------------------------------------------------------------------------
*/
Route::prefix('laporan')->name('laporan.')->group(function () {

    // Penjualan
    Route::get('/penjualan', [PenjualanController::class, 'laporan'])->name('penjualan');
    Route::get('/penjualan/export', [PenjualanController::class, 'export'])->name('penjualan.export');

    // Produk
    Route::get('/produk', [ProdukController::class, 'laporanProduk'])->name('produk');
    Route::get('/produk/export', [ProdukController::class, 'export'])->name('produk.export');

    // Pengguna
    Route::get('/pengguna', [PenggunaController::class, 'laporanPengguna'])->name('pengguna');
    Route::get('/pengguna/export', [PenggunaController::class, 'export'])->name('pengguna.export');
});

/*
|--------------------------------------------------------------------------
| Image
|--------------------------------------------------------------------------
*/
Route::get('/produk-image/{filename}', [ImageController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Discount
|--------------------------------------------------------------------------
*/
Route::resource('discount', DiscountController::class);

Route::patch('/discount/{id}/toggle', [DiscountController::class, 'toggle'])
    ->name('discount.toggle');
    // Route khusus untuk Admin yang sudah login
Route::middleware(['auth:admin'])->group(function () {
    
    // Proses Update Profile Admin
    Route::put('/admin/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');

    // Proses Logout Admin
    Route::post('/logout', function (Request $request) {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login'); // Arahkan ke halaman login admin Anda setelah logout
    })->name('logout');
});
// ==========================================
// AUTENTIKASI ADMIN RESMI
// ==========================================

// GUEST: Hanya bisa diakses jika BELUM login
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [ProfileController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ProfileController::class, 'login'])->name('login.submit');
});

// AUTH: Hanya bisa diakses jika SUDAH login sebagai Admin
Route::middleware(['auth:admin'])->group(function () {
    
    // Route Update Profile Admin yang sesungguhnya (Sudah Terproteksi)
    Route::put('/admin/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');

    // Route Logout Admin
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
});