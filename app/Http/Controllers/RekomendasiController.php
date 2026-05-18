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
        $analisis = Analisis::with('user')
            ->latest()
            ->paginate(10, ['*'], 'analisis_page');

        return view('ai.dataset', compact('rekomendasis', 'analisis'));
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
        $analisis = Analisis::latest()->get();

        return view('ai.dataset', compact('rekomendasis', 'hasil', 'analisis'));
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

    public function destroyAnalisis($id)
    {
        Analisis::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', 'Data analisis berhasil dihapus');
    }

}
