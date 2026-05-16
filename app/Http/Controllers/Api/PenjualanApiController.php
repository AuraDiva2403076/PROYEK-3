<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;

class PenjualanApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'id_pelanggan' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'total' => 'required',
            'status' => 'required',
            'metode' => 'required',
        ]);

        $penjualan = Penjualan::create([
            'kode_pesanan' => 'ORD-' . time(),
            'id_produk' => $request->id_produk,
            'id_pelanggan' => $request->id_pelanggan,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total' => $request->total,
            'tanggal' => now(),
            'status' => $request->status,
            'metode' => $request->metode,
        ]);

        return response()->json([
            'message' => 'Penjualan berhasil disimpan',
            'data' => $penjualan
        ], 201);
    }
}
