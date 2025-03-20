<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Kolom user_id untuk mengaitkan dengan pengguna
            $table->unsignedBigInteger('produk_id');
            $table->text('alamat'); // Alamat pengiriman
            $table->string('telepon'); // Nomor telepon
            $table->integer('jumlah')->default(1); // Jumlah produk dalam pesanan
            $table->decimal('totalharga', 10, 2); // Total harga pesanan
            $table->enum('status', ['sedang_diproses','dalam_perjalanan', 'selesai', 'cancel'])->default('sedang_diproses'); // Status pesanan
            $table->enum('pembayaran', ['DANA', 'Gopay', 'BNI', 'Mandiri', 'BRI', 'BCA','COD'])->nullable(); // Metode pembayaran
            $table->timestamps(); // Kolom created_at dan updated_at

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
