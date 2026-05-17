<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Discount;

class DiscountApiController extends Controller
{
    public function index()
    {
        $discounts = Discount::where('is_active', true)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $discounts
        ]);
    }
}