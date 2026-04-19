<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class ProdukApiController extends Controller
{
  public function index()
{
    $produks = Produk::latest()->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'kode_produk' => $item->kode_produk,
            'name' => $item->nama_produk,
            'ukuran' => $item->ukuran,
            'kategori' => $item->kategori,
            'price' => (int) $item->harga,
            'warna' => $item->warna,
            'stok' => (int) $item->stok,
            'deskripsi' => $item->deskripsi,
            'image' => $item->gambar ? url('produk-image/' . basename($item->gambar)) : null,
            'created_at' => $item->created_at,
        ];
    });

    return response()->json([
        'success' => true,
        'data' => $produks,
    ]);
}
    }
