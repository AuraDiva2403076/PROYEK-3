<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukGambar extends Model
{
    protected $fillable = ['produk_id', 'gambar'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
