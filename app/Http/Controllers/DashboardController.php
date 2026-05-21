<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = $this->getDashboardData();

        return view('dashboard', $data);
    }

    public function data()
    {
        return response()->json($this->getDashboardData());
    }

    private function getDashboardData()
    {
        // Statistik atas
        $totalPesanan = Penjualan::count();

        $totalProduk = Produk::count();

        $totalPendapatan = Penjualan::where('status', 'Selesai')
            ->sum('total');

        $totalPengguna = User::count();

        // Grafik penjualan per bulan (SQLite)
        $grafikPenjualan = Penjualan::select(
                DB::raw("strftime('%m', tanggal) as bulan"),
                DB::raw("SUM(total) as total")
            )
            ->whereYear('tanggal', now()->year)
            ->groupBy(DB::raw("strftime('%m', tanggal)"))
            ->orderBy(DB::raw("strftime('%m', tanggal)"))
            ->get();

        // Produk terlaris
        $produkTerlaris = Penjualan::join(
                'produks',
                'penjualans.id_produk',
                '=',
                'produks.kode_produk'
            )
            ->select(
                'produks.nama_produk',
                DB::raw('SUM(penjualans.jumlah) as total_terjual')
            )
            ->groupBy(
                'produks.kode_produk',
                'produks.nama_produk'
            )
            ->orderByDesc('total_terjual')
            ->take(4)
            ->get();

        return compact(
            'totalPesanan',
            'totalProduk',
            'totalPendapatan',
            'totalPengguna',
            'grafikPenjualan',
            'produkTerlaris'
        );
    }
}