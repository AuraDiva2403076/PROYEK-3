<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProdukExport;

class ProdukController extends Controller
{
    // =======================
    // CRUD PRODUK
    // =======================
    public function index(Request $request)
    {
        $query = Produk::query();

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('warna', 'like', '%' . $request->search . '%');
            });
        }

        // 🎯 FILTER
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->ukuran) {
            $query->where('ukuran', $request->ukuran);
        }

        $produks = $query->latest()->paginate(8)->withQueryString();

        return view('katalog', compact('produks'));
    }

    public function create()
    {
        return view('produk.tambah_produk');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }

            // simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('katalog');
    }

    // =======================
    // LAPORAN PRODUK
    // =======================
    public function laporanProduk(Request $request)
    {
        $query = Produk::query();

        // 🔍 FILTER PRODUK
        if ($request->produk) {
            $query->where('id', $request->produk);
        }

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->ukuran) {
            $query->where('ukuran', $request->ukuran);
        }

        if ($request->warna) {
            $query->where('warna', $request->warna);
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        $produk = Produk::all(); // untuk dropdown filter

        return view('laporan.produk', compact('data', 'produk'));
    }

    public function export(Request $request)
    {
        $query = Produk::query();

        // Filter biasa
        if ($request->produk) $query->where('id', $request->produk);
        if ($request->kategori) $query->where('kategori', $request->kategori);
        if ($request->ukuran) $query->where('ukuran', $request->ukuran);
        if ($request->warna) $query->where('warna', $request->warna);

        // 🔹 FILTER BY CHECKBOX SELECTION
        if ($request->ids) {
            $ids = json_decode($request->ids); // convert JSON ke array
            if (is_array($ids) && count($ids) > 0) {
                $query->whereIn('id', $ids);
            }
        }

        $data = $query->get();

        $type = $request->type ?? 'pdf';

        if ($type == 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.produk_pdf', compact('data'));
            return $pdf->download('laporan_produk.pdf');
        } elseif ($type == 'excel') {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ProdukExport($data), 'laporan_produk.xlsx');
        } elseif ($type == 'csv') {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ProdukExport($data), 'laporan_produk.csv');
        }
    }
}
