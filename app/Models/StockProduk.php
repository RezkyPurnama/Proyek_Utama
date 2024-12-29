<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduk extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'stockproduk';

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['produk_id', 'stock'];

    /**
     * Relasi ke model Produk.
     * Setiap entri stok produk terkait dengan satu produk.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
