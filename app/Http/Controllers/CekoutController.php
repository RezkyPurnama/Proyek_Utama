<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Cekout;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CekoutController extends Controller
{
    // Menampilkan halaman cekout untuk pengguna yang sedang login
    public function index()
    {
        $user_id = Auth::id(); // Ambil ID user yang sedang login

        if (!$user_id) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil semua data keranjang berdasarkan user_id
        $keranjangs = Keranjang::where('user_id', $user_id)->get();

        // Hitung total harga berdasarkan jumlah produk di keranjang
        $total = 0;
        foreach ($keranjangs as $keranjang) {
            $total += $keranjang->produk->harga * $keranjang->jumlah;
        }

        // Ambil data cekout terakhir untuk user
        $cekout = Cekout::where('user_id', $user_id)->latest()->first();  // Ambil checkout terakhir jika ada

        // Hitung jumlah produk dalam keranjang
        $totalItems = $keranjangs->sum('jumlah');  // Jumlah total produk dalam keranjang

        // Kembalikan tampilan dengan data keranjang, total harga, totalItems, dan cekout
        return view('dashboarduser.cekout.index', compact('keranjangs', 'total', 'totalItems', 'cekout'));
    }

    public function proses(Request $request)
    {
        $user_id = Auth::id(); // Ambil ID user yang sedang login

        if (!$user_id) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data keranjang berdasarkan user_id
        $keranjangs = Keranjang::where('user_id', $user_id)->get();
        if ($keranjangs->isEmpty()) {
            return redirect()->route('dashboarduser.keranjang.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Validasi stok produk
        foreach ($keranjangs as $keranjang) {
            $produk = $keranjang->produk;
            if ($keranjang->jumlah > $produk->stockproduk->stock) {
                return redirect()->route('dashboarduser.keranjang.index')->with('error', "Stok produk '{$produk->nama}' tidak mencukupi.");
            }
        }

        // Hitung total harga checkout berdasarkan produk di keranjang
        $total_harga = 0;
        foreach ($keranjangs as $keranjang) {
            $total_harga += $keranjang->produk->harga * $keranjang->jumlah;
        }

        // Mengonfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$clientKey = config('midtrans.clientKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // Data untuk transaksi Midtrans
        $transactionDetails = [
            'order_id' => 'ORDER-' . time(),
            'gross_amount' => $total_harga,
        ];

        // Detail item untuk transaksi
        $itemDetails = $keranjangs->map(function ($item) {
            return [
                'id' => $item->produk->id,
                'price' => $item->produk->harga,
                'quantity' => $item->jumlah,
                'name' => $item->produk->nama_produk,
            ];
        })->toArray();

        // Data customer untuk transaksi
        $customerDetails = [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone ?? '08123456789',
            'address' => $request->input('alamat'),
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $response = Snap::createTransaction($params);
            $snapToken = $response->token ?? null;

            if (!$snapToken) {
                throw new \Exception("Gagal mendapatkan Snap Token.");
            }

            // Menyimpan data checkout
            $cekout = Cekout::create([
                'user_id' => $user_id,
                'alamat' => $request->input('alamat'),
                'total_harga' => $total_harga,
                'status' => 'pending',
                'snap_token' => $snapToken,
            ]);

            // Mengaitkan keranjang dengan cekout
            foreach ($keranjangs as $keranjang) {
                $keranjang->cekout_id = $cekout->id; // Pastikan cekout_id ada di tabel keranjangs
                $keranjang->save();
            }

            // Menampilkan hasil checkout
            return view('dashboarduser.cekout.index', compact('cekout', 'keranjangs', 'total_harga', 'snapToken'));

        } catch (\Exception $e) {
            Log::error('Kesalahan proses pembayaran: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pembayaran: ' . $e->getMessage());
        }
    }

    // Fungsi untuk menghapus produk dari keranjang sebelum cekout
    public function destroy($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        return redirect()->route('dashboarduser.keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function show($pembayaran)
    {
        $userId = Auth::id();
        $cekout = Cekout::with('produk')->where('user_id', $userId)->latest()->paginate(10);
        return view('dashboard.pesanan.pembayaran', [
            'cekout' => $cekout,
            'pembayaran' => $pembayaran, // Menambahkan parameter pembayaran ke view
        ]);
    }
}
