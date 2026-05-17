<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'product_id',
        'discount_percent',
        'banner',
        'start_date',
        'end_date',
        'is_active'
    ];
}