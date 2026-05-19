<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class ProdukApiController extends Controller
{
    public function index()
    {
        $baseUrl = request()->getSchemeAndHttpHost();

        $produks = Produk::with(['gambars', 'ukurans'])
            ->latest()
            ->get()
            ->map(function ($item) use ($baseUrl) {
                $ukuranTerpilih = $item->ukurans
                    ->filter(fn($u) => $u->harga !== null && $u->harga > 0);

                $gambarPertama = $item->gambars->first();

                return [
                    'id' => $item->id,
                    'kode_produk' => $item->kode_produk,
                    'name' => $item->nama_produk,
                    'kategori' => $item->kategori,
                    'warna' => $item->warna,
                    'deskripsi' => $item->deskripsi,

                    'ukurans' => $ukuranTerpilih->map(fn($u) => [
                        'ukuran' => $u->ukuran,
                        'stok' => $u->stok,
                        'harga' => $u->harga,
                    ])->values(),

                    'price' => (int) ($ukuranTerpilih->min('harga') ?? 0),

                    'gambars' => $item->gambars->map(fn($g) =>
                        $baseUrl . '/storage/' . $g->gambar
                    )->values(),

                    'image' => $gambarPertama
                        ? $baseUrl . '/storage/' . $gambarPertama->gambar
                        : null,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $produks,
        ]);
    }
}