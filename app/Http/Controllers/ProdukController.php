<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->paginate(8);
        return view('katalog', compact('produks'));
    }

    public function create()
    {
        return view('produk.tambah_produk');
    }

    public function store(Request $request)
{
    $gambar = $request->file('gambar')->store('produk','public');

    Produk::create([
        'kode_produk' => $request->kode_produk,
        'nama_produk' => $request->nama_produk,
        'ukuran' => $request->ukuran,
        'kategori' => $request->kategori,
        'stok' => $request->stok,
        'warna' => $request->warna,
        'harga' => $request->harga,
        'deskripsi' => $request->deskripsi,
        'gambar' => $gambar,
    ]);

    return response()->json(['success' => true]);
}
public function destroy($id)
{
    $produk = Produk::findOrFail($id);

    if($produk->gambar){
        \Storage::disk('public')->delete($produk->gambar);
    }

    $produk->delete();

    return redirect()->route('katalog');
}
public function update(Request $request, $id)
{
    $produk = Produk::findOrFail($id);

    $data = $request->all();

    if($request->hasFile('gambar')){
        $gambar = $request->file('gambar')->store('produk','public');
        $data['gambar'] = $gambar;
    }

    $produk->update($data);

    return response()->json(['success' => true]);
}
public function katalog(Request $request)
{
    $query = Produk::query();

    if ($request->kategori) {
        $query->where('kategori', $request->kategori);
    }

    if ($request->ukuran) {
        $query->where('ukuran', $request->ukuran);
    }

    $produks = $query->paginate(10);

    return view('katalog', compact('produks'));
}


}
