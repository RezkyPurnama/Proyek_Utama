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
        // Menambahkan kolom totalharga pada tabel keranjangs
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->decimal('totalharga', 12, 2)->after('jumlah')->default(0); // Kolom totalharga
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->dropColumn('totalharga');
        });
    }
};
