<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    /**
     * Tampilkan halaman dashboard dengan data statistik.
     */
    public function index()
    {
        // Data statistik
        $jumlahUser = User::count();
        $jumlahProduk = Produk::count();
        $pesananMasuk = Order::count();
        $userDetails = User::all();
        $totalPendapatan = Order::where('status', 'completed')->sum('totalharga');





        // Data penjualan bulanan
        $penjualanBulanan = Order::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
            DB::raw('SUM(totalharga) as total_penjualan')
        )
            ->groupBy('bulan')
            ->orderBy('bulan', 'ASC')
            ->get();

        // Data penjualan harian
        $penjualanHarian = Order::select(
            DB::raw('DATE(created_at) as tanggal'),
            DB::raw('SUM(totalharga) as total_penjualan')
        )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        // Konversi data untuk grafik bulanan
        $bulan = $penjualanBulanan->pluck('bulan')->toArray();
        $totalPenjualanBulanan = $penjualanBulanan->pluck('total_penjualan')->toArray();

        // Konversi data untuk grafik harian
        $tanggal = $penjualanHarian->pluck('tanggal')->toArray();
        $totalPenjualanHarian = $penjualanHarian->pluck('total_penjualan')->toArray();

        // Kirim data ke view
        return view('welcome', compact(
            'jumlahUser',
            'jumlahProduk',
            'pesananMasuk',
            'userDetails',
            'bulan',
            'totalPenjualanBulanan',
            'tanggal',
            'totalPenjualanHarian',
            'totalPendapatan',

        ));
    }
}
