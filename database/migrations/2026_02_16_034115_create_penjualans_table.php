<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan');
            $table->string('id_produk');
            $table->string('id_pelanggan');
            $table->integer('jumlah');
            $table->decimal('harga', 12, 2);
            $table->decimal('total', 12, 2);
            $table->date('tanggal');
            $table->enum('status', ['Selesai', 'Batal', 'Dalam Proses']);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
