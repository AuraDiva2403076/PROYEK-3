<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function show($filename)
    {
        $path = storage_path('app/public/produk/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Access-Control-Allow-Origin' => '*',
            'Cross-Origin-Resource-Policy' => 'cross-origin',
        ]);
    }
}