<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    protected $table = 'analisis';

    protected $fillable = [
        'user_id',
        'kode',
        'warna_kulit',
        'rekomendasi_warna',
        'brightness',
        'lab_l',
        'foto',
    ];
}
