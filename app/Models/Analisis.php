<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
