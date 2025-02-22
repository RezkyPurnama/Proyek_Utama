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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Kolom user_id untuk mengaitkan dengan pengguna
            $table->unsignedBigInteger('produk_id'); // Kolom produk_id untuk mengaitkan dengan produk
            $table->timestamps();

             // Menambahkan foreign key constraint
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
