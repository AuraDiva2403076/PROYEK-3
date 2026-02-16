<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
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
}
