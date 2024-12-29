<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Menampilkan halaman daftar keranjang dan total harga
    public function index()
    {
        $user_id = Auth::id(); // Ambil ID user yang sedang login

        if (!$user_id) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil semua data keranjang berdasarkan user_id
        $keranjangs = Keranjang::where('user_id', $user_id)->with('produk')->get();

        // Validasi jika keranjang kosong
        if ($keranjangs->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung total harga berdasarkan jumlah produk di keranjang
        $total = $keranjangs->sum(fn($k) => $k->produk->harga * $k->jumlah);

        // Hitung jumlah produk dalam keranjang
        $totalItems = $keranjangs->sum('jumlah');

        return view('dashboarduser.order.index', compact('keranjangs', 'total', 'totalItems'));
    }

    // Fungsi pembayaran
    public function pembayaran(Request $request)
    {
        $user_id = Auth::id();

        if (!$user_id) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'pembayaran' => 'required|in:DANA,Gopay,BNI,Mandiri,BRI,BCA',
        ]);

        DB::beginTransaction();
        try {
            $keranjangs = Keranjang::where('user_id', $user_id)->with('produk.stockproduk')->get();

            if ($keranjangs->isEmpty()) {
                return redirect()->route('order.index')->with('error', 'Keranjang Anda kosong.');
            }

            // Membuat transaction_id unik untuk pesanan ini (hanya sekali)
            $transaction_id = 'TXN-' . strtoupper(uniqid());
            $totalHargaPesanan = 0;

            foreach ($keranjangs as $keranjang) {
                if ($keranjang->produk && $keranjang->jumlah <= $keranjang->produk->stockproduk->stock) {
                    // Membuat order untuk setiap produk dengan transaction_id yang sama
                    Order::create([
                        'user_id' => $user_id,
                        'produk_id' => $keranjang->produk_id,
                        'alamat' => $request->input('alamat'),
                        'telepon' => $request->input('no_telepon'),
                        'jumlah' => $keranjang->jumlah,
                        'totalharga' => $keranjang->produk->harga * $keranjang->jumlah,
                        'status' => 'pending',
                        'pembayaran' => $request->input('pembayaran'),
                        'transaction_id' => $transaction_id, // Sama untuk semua produk
                    ]);

                    // Mengurangi stok produk sesuai jumlah yang dipesan
                    $keranjang->produk->stockproduk->decrement('stock', $keranjang->jumlah);

                    // Menambahkan total harga pesanan
                    $totalHargaPesanan += $keranjang->produk->harga * $keranjang->jumlah;
                } else {
                    DB::rollBack();
                    return redirect()->route('order.index')->with('error', 'Stok produk "' . $keranjang->produk->nama . '" tidak mencukupi.');
                }
            }

            // Menghapus semua item di keranjang setelah berhasil checkout
            Keranjang::where('user_id', $user_id)->delete();

            // Menyimpan data transaksi ke session
            session([
                'total' => $totalHargaPesanan,
                'pembayaran' => $request->input('pembayaran'),
                'transaction_id' => $transaction_id,
            ]);

            DB::commit();

            return redirect()->route('order.upload');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat checkout: ' . $e->getMessage());
            return redirect()->route('order.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    // Fungsi untuk menampilkan halaman sukses pembayaran
    public function paymentSuccess(Request $request)
    {
        // Ambil data yang diperlukan untuk menampilkan detail pembayaran
        $total = session('total', 0);
        $pembayaran = session('pembayaran', 'Tidak diketahui');
        $transaction_id = session('transaction_id', 'Tidak diketahui');

        return view('dashboarduser.order.sukses', compact('total', 'pembayaran', 'transaction_id'));
    }

    public function uploadBuktiPembayaran(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Simpan file gambar ke storage
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

            // Mendapatkan transaction_id dari session
            $transaction_id = session('transaction_id');

            if (!$transaction_id) {
                return back()->with('error', 'Data transaksi tidak ditemukan.');
            }

            // Update semua order dengan transaction_id yang sama
            $orders = Order::where('transaction_id', $transaction_id)->get();

            if ($orders->isEmpty()) {
                return back()->with('error', 'Pesanan tidak ditemukan.');
            }

            foreach ($orders as $order) {
                $order->bukti_pembayaran = $path;
                $order->save();
            }

            return redirect()->route('order.success')->with('success', 'Bukti pembayaran berhasil diunggah.');
        } catch (\Exception $e) {
            Log::error('Gagal mengunggah bukti pembayaran: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengunggah bukti pembayaran.');
        }
    }


    public function showUploadBukti()
    {
        $total = session('total', 0);
        $pembayaran = session('pembayaran', 'Tidak diketahui');
        $transaction_id = session('transaction_id', 'Tidak diketahui');

        return view('dashboarduser.order.buktipembayaran', compact('total', 'pembayaran', 'transaction_id'));
    }
}
