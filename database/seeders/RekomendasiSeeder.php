<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rekomendasi;

class RekomendasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

public function run(): void
{
    Rekomendasi::create([
        'warna_kulit' => 'Putih',
        'undertone' => null,
        'rekomendasi_warna' => 'hitam, merah marun, navy, ungu, kuning, merah, merah muda',
        'kesan' => null,
    ]);

    Rekomendasi::create([
        'warna_kulit' => 'Kuning Langsat',
        'undertone' => null,
        'rekomendasi_warna' => 'merah, ungu, biru, kuning, pink terang, hijau muda, hitam, putih',
        'kesan' => null,
    ]);

    Rekomendasi::create([
        'warna_kulit' => 'Sawo Matang',
        'undertone' => 'Kuning / Netral',
        'rekomendasi_warna' => 'beige, cream, cokelat muda, mint green, baby blue, soft pink, dusty pink, lavender, sky blue, terracotta, olive green, mustard yellow, merah maroon, emerald green, navy blue, gold, bronze, hitam, putih',
        'kesan' => 'Natural, elegan, fresh, glamor, glowing',
    ]);

    Rekomendasi::create([
        'warna_kulit' => 'Gelap',
        'undertone' => null,
        'rekomendasi_warna' => 'kuning terang, hijau sage, biru elektrik, silver, emas, lavender, coksu, pink',
        'kesan' => 'Kontras, cerah',
    ]);
}

    }

