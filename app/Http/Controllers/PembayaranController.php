<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        // Ambil data keranjang milik user yang sedang login
        $keranjangs = Keranjang::where('user_id', Auth::id())->get();

        // Hitung total pembayaran dari keranjang
        $total = $keranjangs->sum(function($keranjang) {
            return $keranjang->produk->harga * $keranjang->jumlah;
        });

        // Simpan total pembayaran dalam session untuk digunakan pada proses pembayaran
        session(['total' => $total]);

        return view('dashboarduser.pembayaran.index', compact('keranjangs', 'total'));
    }

    public function prosesPembayaran(Request $request)
    {
        // Validasi input yang diterima
        $request->validate([
            'alamat' => 'required|string|max:500',
            'metode_pembayaran' => 'required|string',
        ]);

        // Ambil total pembayaran dari session yang disimpan sebelumnya
        $total = session('total');
        if (!$total) {
            return redirect()->route('pembayaran.index')->with('error', 'Total pembayaran tidak ditemukan.');
        }

        // Ambil nama pembeli dari user yang sedang login
        $nama_pembeli = Auth::user()->name; 


        Keranjang::where('user_id', Auth::id())->delete();

        // Redirect ke halaman pembayaran sukses atau konfirmasi
        return redirect()->route('pembayaran.sukses')->with('success', 'Pembayaran berhasil diproses.');
    }

    public function sukses()
    {
        // Menampilkan halaman sukses pembayaran
        return view('dashboarduser.pembayaran.sukses');
    }
}
