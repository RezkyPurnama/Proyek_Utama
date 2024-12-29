<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class PesananMasukController extends Controller
{
    // Menampilkan daftar pesanan yang masuk
    public function index()
    {
        // Ambil semua pesanan dengan status 'pending'
        $pesananMasuk = Order::with('produk')->get();

        return view('pesanan_masuk.index', compact('pesananMasuk'));
    }

    // Fungsi untuk mengubah status pesanan menjadi 'dikirim' (misalnya)
    public function updateStatus(Request $request, $id)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed,cancelled',
        ]);

        // Cari pesanan berdasarkan ID
        $pesanan = Order::findOrFail($id);

        // Perbarui status dengan input baru
        $pesanan->status = $request->input('status');
        $pesanan->save();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('pesananmasuk.index');
    }


     // Fungsi untuk mencetak laporan dalam bentuk PDF
     public function cetakLaporan()
     {
         // Ambil data pesanan masuk
         $pesananMasuk = Order::with('produk')->get();

         $pdf = PDF::loadView('pesanan_masuk.pdf', compact('pesananMasuk'))
         ->setPaper('A4', 'landscape'); // Orientasi landscape


         // Download PDF dengan nama 'laporan_pesanan.pdf'
         return $pdf->download('laporan_pesanan.pdf');
     }


}