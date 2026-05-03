<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori',
        'warna',
        'deskripsi',
    ];

    public function gambars()
    {
        return $this->hasMany(ProdukGambar::class);
    }

    public function ukurans()
    {
        return $this->hasMany(ProdukUkuran::class);
    }

    public function getTotalStokAttribute()
    {
        return $this->ukurans->sum('stok');
    }
}
