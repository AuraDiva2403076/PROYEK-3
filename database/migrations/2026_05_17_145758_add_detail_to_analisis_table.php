<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('analisis', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->text('rekomendasi_warna')->nullable()->after('warna_kulit');
            $table->double('brightness')->nullable()->after('rekomendasi_warna');
            $table->double('lab_l')->nullable()->after('brightness');
        });
    }

    public function down(): void
    {
        Schema::table('analisis', function (Blueprint $table) {
            $table->dropColumn([
                'user_id',
                'rekomendasi_warna',
                'brightness',
                'lab_l',
            ]);
        });
    }
};
