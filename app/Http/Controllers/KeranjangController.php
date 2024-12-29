<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Menampilkan keranjang belanja pengguna yang sedang login
    public function index()
    {
        $user_id = Auth::id();  // Ambil ID user yang sedang login

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

        // Hitung jumlah produk dalam keranjang
        $totalItems = $keranjangs->sum('jumlah');  // Jumlah total produk dalam keranjang

        // Kembalikan tampilan dengan data keranjang, total harga, dan totalItems
        return view('dashboarduser.keranjang.index', compact('keranjangs', 'total', 'totalItems'));
    }

    // Fungsi untuk menambah produk ke keranjang
    public function tambahKeKeranjang(Request $request, $produk_id)
    {
        $user_id = Auth::id();  // Ambil ID user yang sedang login

        if (!$user_id) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $produk = Produk::findOrFail($produk_id);
        $jumlah_pesan = $request->input('jumlah_pesan', 1); // Default jumlah 1 jika tidak diisi

        // Validasi stok produk
        if ($jumlah_pesan > $produk->stockproduk->stock) {
            return redirect()->back()->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
        }

        // Hitung total jumlah produk dalam keranjang untuk user ini
        $totalItemsInCart = Keranjang::where('user_id', $user_id)->sum('jumlah');

        // Validasi batas maksimal produk dalam keranjang
        $maxItemsAllowed = 200; // Batas maksimal
        if (($totalItemsInCart + $jumlah_pesan) > $maxItemsAllowed) {
            return redirect()->back()->with('error', "Anda hanya dapat memesan hingga $maxItemsAllowed produk.");
        }

        // Cari keranjang dengan user_id dan produk_id
        $keranjang = Keranjang::where('user_id', $user_id)->where('produk_id', $produk_id)->first();

        if ($keranjang) {
            // Tambahkan jumlah produk
            $keranjang->jumlah += $jumlah_pesan;

            // Validasi stok setelah update jumlah
            if ($keranjang->jumlah > $produk->stockproduk->stock) {
                return redirect()->back()->with('error', 'Jumlah total melebihi stok yang tersedia.');
            }

            $keranjang->totalharga = $keranjang->produk->harga * $keranjang->jumlah;
            $keranjang->save();
        } else {
            // Buat keranjang baru
            $totalharga = $produk->harga * $jumlah_pesan;

            Keranjang::create([
                'user_id' => $user_id,
                'produk_id' => $produk_id,
                'jumlah' => $jumlah_pesan,
                'totalharga' => $totalharga,
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }




    // Fungsi untuk memperbarui jumlah produk di keranjang
    public function updateJumlah(Request $request, $id)
    {
        // Cari data keranjang berdasarkan ID
        $keranjang = Keranjang::findOrFail($id);
        $jumlah_baru = $request->input('jumlah'); // Ambil jumlah baru yang dikirimkan dari tombol + atau -

        // Validasi untuk memastikan jumlah lebih dari 0 dan tidak melebihi stok produk
        if ($jumlah_baru < 1) {
            return redirect()->route('keranjang.index')->with('error', 'Jumlah produk tidak bisa kurang dari 1.');
        }

        // Validasi untuk memastikan jumlah tidak melebihi stok produk
        if ($jumlah_baru > $keranjang->produk->stockproduk->stock) {
            return redirect()->route('keranjang.index')->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
        }

        // Hitung total harga baru berdasarkan jumlah yang diupdate
        $totalharga = $keranjang->produk->harga * $jumlah_baru;

        // Update jumlah produk di keranjang dan total harga
        $keranjang->jumlah = $jumlah_baru;
        $keranjang->totalharga = $totalharga;
        $keranjang->save();

        return redirect()->route('keranjang.index');
    }



    // Fungsi untuk menghapus produk dari keranjang
    public function destroy($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
