<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukUkuran extends Model
{
    protected $fillable = [
        'produk_id',
        'ukuran',
        'stok',
        'harga',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
