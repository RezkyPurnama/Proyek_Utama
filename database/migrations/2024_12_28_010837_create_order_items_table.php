<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('order_id'); // Relasi dengan order
            $table->unsignedBigInteger('produk_id'); // Relasi dengan produk
            $table->integer('jumlah'); // Jumlah produk yang dipesan
            $table->decimal('harga', 10, 2); // Harga per produk
            $table->decimal('total_harga', 10, 2); // Total harga untuk produk ini (jumlah * harga)
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan relasi ke tabel orders dan produk
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
}
