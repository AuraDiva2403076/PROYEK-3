<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/katalog', function () {
    return "Halaman Katalog Produk";
})->name('katalog');

Route::get('/penjualan', function () {
    return "Halaman Penjualan";
})->name('penjualan');
