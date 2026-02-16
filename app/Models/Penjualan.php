<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    public function scopeFilter($query, $request)
    {
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal', [
                $request->start_date,
                $request->end_date
            ]);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->produk) {
            $query->where('id_produk', $request->produk);
        }

        return $query;
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
