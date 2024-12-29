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
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan kolom transaction_id tanpa constraint unique
            $table->string('transaction_id')->after('pembayaran');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menghapus kolom transaction_id
            $table->dropColumn('transaction_id');
        });
    }
};
