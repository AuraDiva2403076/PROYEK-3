<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;

        // Produk
        $produk = Produk::where('nama_produk', 'LIKE', "%{$keyword}%")
            ->orWhere('kategori', 'LIKE', "%{$keyword}%")
            ->orWhere('harga', 'LIKE', "%{$keyword}%")
            ->get();

        // Penjualan
        $penjualan = Penjualan::join('produks', 'penjualans.id_produk', '=', 'produks.id')
            ->select(
                'penjualans.*',
                'produks.nama_produk'
            )
            ->where('produks.nama_produk', 'LIKE', "%{$keyword}%")
            ->orWhere('penjualans.status', 'LIKE', "%{$keyword}%")
            ->orWhere('penjualans.total', 'LIKE', "%{$keyword}%")
            ->orWhere('penjualans.tanggal', 'LIKE', "%{$keyword}%")
            ->get();

        // Pengguna
        $pengguna = User::where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('email', 'LIKE', "%{$keyword}%")
            ->get();

        return view('search.index', compact(
            'keyword',
            'produk',
            'penjualan',
            'pengguna'
        ));
    }
}