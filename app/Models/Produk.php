<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function stockproduk()
    {
        return $this->hasOne(StockProduk::class, 'produk_id');
    }
    public function kategori()
    {
        return $this->belongsTo(Categori::class, 'kategori_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'produk_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
