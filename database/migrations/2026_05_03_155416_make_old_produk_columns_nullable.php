<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->string('ukuran')->nullable()->change();
            $table->integer('stok')->nullable()->change();
            $table->integer('harga')->nullable()->change();
            $table->string('gambar')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->string('ukuran')->nullable(false)->change();
            $table->integer('stok')->nullable(false)->change();
            $table->integer('harga')->nullable(false)->change();
            $table->string('gambar')->nullable(false)->change();
        });
    }
};
