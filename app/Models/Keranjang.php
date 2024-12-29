<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'produk_id', 'jumlah','totalharga']; // Pastikan jumlah ada di sini

    // Relasi ke Produk
    // Di model Keranjang
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}



}
