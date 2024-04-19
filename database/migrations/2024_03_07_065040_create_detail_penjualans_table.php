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
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id('detail_id');

            $table->unsignedBigInteger('penjualan_id');
            $table->foreign('penjualan_id')->references('penjualan_id')->on('penjualans');

            // $table->unsignedBigInteger('pelanggan_id');
            // $table->foreign('pelanggan_id')->references('pelanggan_id')->on('pelanggan');

            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('produk_id')->on('produks');

            $table->integer('jumlah_produk');
            $table->decimal('subtotal', '10', '2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
