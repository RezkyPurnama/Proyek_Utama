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
        Schema::create('stockproduk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id'); // Kolom produk_id sebagai foreign key
            $table->integer('stock');
            $table->timestamps();

            // Tambahkan foreign key constraint
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');

            // Tambahkan indeks unik untuk mencegah duplikasi berdasarkan produk_id
            $table->unique('produk_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockproduk');
    }
};
