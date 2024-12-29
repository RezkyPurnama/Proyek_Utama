<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('keranjangs', function (Blueprint $table) {
        $table->integer('jumlah')->default(1); // Menambah kolom jumlah dengan default 1
    });
}

public function down()
{
    Schema::table('keranjangs', function (Blueprint $table) {
        $table->dropColumn('jumlah'); // Menghapus kolom jumlah saat rollback
    });
}

};
