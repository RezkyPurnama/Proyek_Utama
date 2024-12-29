<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class RiwayatPesananController extends Controller
{
    public function index()
    {
        // Ambil ID pengguna yang sedang login
        $userId = auth()->id();

        // Ambil semua pesanan yang dibuat oleh pengguna ini
        $riwayatPesanan = Order::where('user_id', $userId)
            ->with('produk') // Mengambil relasi produk
            ->orderBy('created_at', 'desc') // Urutkan dari pesanan terbaru
            ->get();

        // Kirim data ke view
        return view('dashboarduser.riwayat_pesanan.index', compact('riwayatPesanan'));
    }
    public function ubahStatus($id)
    {
        $pesanan = Order::findOrFail($id);

        if ($pesanan->status === 'shipped') {
            $pesanan->status = 'completed'; // Ubah status menjadi "completed"
            $pesanan->save();

            return redirect()->back()->with('success', 'Status pesanan berhasil diubah menjadi "Sudah Diterima".');
        }

        return redirect()->back()->with('error', 'Perubahan status tidak dapat dilakukan.');
    }

    public function detail($id)
{
    // Ambil pesanan berdasarkan ID dan pastikan pesanan milik pengguna yang login
    $pesanan = Order::where('id', $id)
        ->where('user_id', auth()->id())
        ->with('produk') // Sertakan relasi produk
        ->firstOrFail();

    // Kirim data pesanan ke view
    return view('dashboarduser.riwayat_pesanan.detail', compact('pesanan'));
}

}
