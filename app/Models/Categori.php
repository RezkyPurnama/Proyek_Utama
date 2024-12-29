<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    use HasFactory;

    protected $table = 'categori'; // Ganti dengan nama tabel yang sesuai

    protected $fillable = ['nama_kategori'];
}
