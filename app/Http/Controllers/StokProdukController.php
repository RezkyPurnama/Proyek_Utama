<?php

namespace App\Http\Controllers;

use App\Models\StockProduk;
use App\Models\Produk;
use Illuminate\Http\Request;

class StokProdukController extends Controller
{
    // Menampilkan Daftar Stok Produk
   public function index(Request $request)
{
    // Query untuk pencarian
    $search = $request->search;
    $stockProduks = StockProduk::with('produk')
        ->when($search, function ($query, $search) {
            return $query->whereHas('produk', function ($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%");
            });
        })
        ->paginate(10);

    // Notifikasi untuk stok kurang dari 15
    $lowStockProducts = StockProduk::with('produk')
        ->where('stock', '<', 15)
        ->get();

    return view('stockproduk.index', compact('stockProduks', 'lowStockProducts'));
}

    // Menampilkan form untuk menambah stok produk
    public function create()
    {
        $produks = Produk::all(); // Mengambil semua produk untuk pilihan produk
        return view('stockproduk.create', compact('produks'));
    }

    // Menyimpan data stok produk baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'produk_id' => 'required|exists:produks,id|unique:stockproduk,produk_id',
            'stock' => 'required|integer|min:0',
        ], [
            'produk_id.unique' => 'Produk sudah ada, tidak bisa ditambahkan lagi.',
        ]);

        // Menyimpan data stok produk
        StockProduk::create($request->all());
        return redirect()->route('stock_produk.index')->with('success', 'Stok produk berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit stok produk
    public function edit($id)
    {
        // Menampilkan data stok produk yang akan diedit
        $stockProduk = StockProduk::findOrFail($id);
        $produks = Produk::all(); // Mengambil semua produk untuk pilihan produk
        return view('stockproduk.edit', compact('stockProduk', 'produks'));
    }

    // Memperbarui data stok produk
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'produk_id' => 'required|exists:produks,id|unique:stockproduk,produk_id,' . $id,
            'stock' => 'required|integer|min:0',
        ], [
            'produk_id.unique' => 'Produk sudah ada, tidak bisa ditambahkan lagi.',
        ]);

        // Mencari stok produk berdasarkan ID
        $stockProduk = StockProduk::findOrFail($id);

        // Memperbarui data stok produk
        $stockProduk->update($request->all());

        // Redirect setelah berhasil memperbarui
        return redirect()->route('stock_produk.index')->with('success', 'Stok produk berhasil diperbarui.');
    }

    // Menghapus data stok produk
    public function destroy($id)
    {
        // Mencari stok produk berdasarkan ID
        $stockProduk = StockProduk::findOrFail($id);

        // Menghapus data stok produk
        $stockProduk->delete();

        // Redirect setelah berhasil menghapus
        return redirect()->route('stock_produk.index')->with('success', 'Stok produk berhasil dihapus.');
    }
}
