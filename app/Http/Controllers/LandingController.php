<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function admin ()
    {
        return view('layouts.main');
    }
    public function pelanggan()
    {
        $produk = Produk::all();

        // Menghitung jumlah barang di keranjang untuk pengguna yang sedang login
        $totalItems = 0;
        if (Auth::check()) {
            $user_id = Auth::id(); // Mendapatkan ID pengguna yang sedang login
            $totalItems = Keranjang::where('user_id', $user_id)->sum('jumlah'); // Menghitung jumlah produk dalam keranjang
        }

        return view('dashboarduser.index', compact('produk', 'totalItems')); // Kirimkan data produk dan totalItems ke view
    }


    public function tentang ()
    {

        return view('dashboarduser.tentangkami.index');
    }
    public function keranjang ()
    {

        return view('dashboarduser.keranjang.index');
    }



}
