<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Yolanda',
            'email' => 'admin@hara.com',
            'phone' => '081234567890',
            'password' => Hash::make('admin123'), // Ganti sesuai kebutuhan Anda nanti
        ]);
    }
}