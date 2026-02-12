<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
    'kode_produk',
    'nama_produk',
    'ukuran',
    'kategori',
    'harga',
    'warna',
    'stok',
    'deskripsi',
    'gambar'
];

}
