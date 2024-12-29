<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'produk_id', 'jumlah', 'harga', 'total_harga'];

    // Relasi ke Order (OrderItem belongs to Order)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke Produk (OrderItem belongs to Produk)
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
