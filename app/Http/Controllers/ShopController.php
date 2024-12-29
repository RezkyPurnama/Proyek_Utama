<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function skincare()
    {
        $produk = Produk::all();

        // Menghitung jumlah barang di keranjang untuk pengguna yang sedang login
        $totalItems = 0;
        if (Auth::check()) {
            $user_id = Auth::id(); // Mendapatkan ID pengguna yang sedang login
            $totalItems = Keranjang::where('user_id', $user_id)->sum('jumlah'); // Menghitung jumlah produk dalam keranjang
        }
        // Ambil produk yang kategori-nya adalah 'Skincare'
        $produk = Produk::whereHas('kategori', function($query) {
            $query->where('nama_kategori', 'Skincare');
        })->get();

        return view('dashboarduser.shop.skincare', compact('produk', 'totalItems'));
    }

    public function kosmetik()
    {
        $produk = Produk::all();

        // Menghitung jumlah barang di keranjang untuk pengguna yang sedang login
        $totalItems = 0;
        if (Auth::check()) {
            $user_id = Auth::id(); // Mendapatkan ID pengguna yang sedang login
            $totalItems = Keranjang::where('user_id', $user_id)->sum('jumlah'); // Menghitung jumlah produk dalam keranjang
        }
        // Ambil produk yang kategori-nya adalah 'Skincare'
        $produk = Produk::whereHas('kategori', function($query) {
            $query->where('nama_kategori', 'Kosmetik');
        })->get();

        return view('dashboarduser.shop.kosmetik', compact('produk','totalItems'));
    }

    public function allproduk()
    {
        // Mengambil semua produk
        $produk = Produk::with('kategori')->get();

        // Menghitung jumlah barang di keranjang untuk pengguna yang sedang login
        $totalItems = 0;
        if (Auth::check()) {
            $user_id = Auth::id(); // Mendapatkan ID pengguna yang sedang login
            $totalItems = Keranjang::where('user_id', $user_id)->sum('jumlah'); // Menghitung jumlah produk dalam keranjang
        }

        // Mengirim data ke view
        return view('dashboarduser.shop.allproduk', compact('produk', 'totalItems'));
    }


}
