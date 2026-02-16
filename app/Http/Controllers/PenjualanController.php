<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan; // Pastikan nama Model kamu benar (Penjualan atau Pesanan)

class PenjualanController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data penjualan dengan pagination (untuk tabel)
        $data = Penjualan::paginate(10); 

        // 2. Hitung statistik berdasarkan kolom 'status' di database
        $totalPesanan = Penjualan::count();
        $selesai = Penjualan::where('status', 'Selesai')->count();
        $batal = Penjualan::where('status', 'Batal')->count();
        $proses = Penjualan::where('status', 'Dalam Proses')->count();

        // 3. Kirim SEMUA variabel ke view
        return view('penjualan', compact('data', 'totalPesanan', 'selesai', 'batal', 'proses'));
    }
}