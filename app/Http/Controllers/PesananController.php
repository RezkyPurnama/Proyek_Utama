<?php

namespace App\Http\Controllers;


use App\Models\Produk;


class PesananController extends Controller
{




    public function index($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->route('dashboarduser.pesan.detail')->with('error', 'Produk tidak ditemukan');
        }

        return view('dashboarduser.pesan.detail', compact('produk'));
    }



}
