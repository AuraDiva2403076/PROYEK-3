<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProdukExport;
use App\Models\ProdukGambar;
use App\Models\ProdukUkuran;

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

        $produks = $query->with(['ukurans', 'gambars'])->latest()->paginate(8)->withQueryString();

        return view('katalog', compact('produks'));
    }

    public function create()
    {
        return view('produk.tambah_produk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'kategori' => 'required',
            'warna' => 'nullable',
            'deskripsi' => 'nullable',

            'ukuran' => 'required|array',
            'ukuran.*' => 'required|string',
            'stok_ukuran' => 'required|array',
            'harga_ukuran' => 'required|array',

            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except([
            'gambar',
            'ukuran',
            'stok',
            'harga',
            'stok_ukuran',
            'harga_ukuran',
        ]);

        $produk = Produk::create($data);

        foreach ($request->ukuran as $ukuran) {
            ProdukUkuran::create([
                'produk_id' => $produk->id,
                'ukuran' => $ukuran,
                'stok' => $request->stok_ukuran[$ukuran] ?? 0,
                'harga' => $request->harga_ukuran[$ukuran] ?? 0,
            ]);
        }

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('produk', 'public');

                ProdukGambar::create([
                    'produk_id' => $produk->id,
                    'gambar' => $path,
                ]);
            }
        }

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
