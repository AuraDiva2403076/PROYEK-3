<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Rekomendasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'warna_kulit',
        'undertone',
        'rekomendasi_warna',
        'kesan'
    ];
}
