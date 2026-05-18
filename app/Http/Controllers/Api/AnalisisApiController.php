<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Analisis;
use Illuminate\Http\Request;

class AnalisisApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|integer',
            'warna_kulit' => 'required|string',
            'rekomendasi_warna' => 'nullable|string',
            'brightness' => 'nullable|numeric',
            'lab_l' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('analisis', 'public');
        }

        $analisis = Analisis::create([
            'user_id' => $request->user_id,
            'kode' => 'AI-' . time(),
            'warna_kulit' => $request->warna_kulit,
            'rekomendasi_warna' => $request->rekomendasi_warna,
            'brightness' => $request->brightness,
            'lab_l' => $request->lab_l,
            'foto' => $fotoPath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Hasil analisis berhasil disimpan',
            'data' => $analisis,
        ]);
    }

    public function history($user_id)
    {
        $data = Analisis::where('user_id', $user_id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
