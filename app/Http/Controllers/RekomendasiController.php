<?php

namespace App\Http\Controllers;
use App\Models\Rekomendasi;
use App\Models\Analisis;
use Illuminate\Http\Request;


class RekomendasiController extends Controller
{
    public function index()
{
    $rekomendasis = Rekomendasi::latest()->paginate(5);
    $analisis = collect(); // kosong

    return view('ai.dataset', compact('rekomendasis','analisis'));
}

    public function store(Request $request)
    {
        Rekomendasi::create($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Rekomendasi::findOrFail($id)->delete();

        return redirect()->back();
    }
    public function predict(Request $request)
{
    $request->validate([
        'jenis' => 'required',
        'undertone' => 'required',
    ]);

    $hasil = Rekomendasi::where('warna_kulit', $request->jenis)
                ->where('undertone', $request->undertone)
                ->first();

    $rekomendasis = Rekomendasi::latest()->paginate(5);

    return view('ai.dataset', compact('rekomendasis', 'hasil'));
}
public function edit($id)
{
    $data = Rekomendasi::findOrFail($id);
    return view('ai.edit', compact('data'));
}

public function update(Request $request, $id)
{
    $data = Rekomendasi::findOrFail($id);

    $data->update([
        'warna_kulit' => $request->warna_kulit,
        'undertone' => $request->undertone,
        'rekomendasi_warna' => $request->rekomendasi_warna,
    ]);

    return redirect()->route('dataset-ai.index')
            ->with('success','Data berhasil diupdate');
}

}