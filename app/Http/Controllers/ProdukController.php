<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Categori; // Tambahkan model kategori
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Menampilkan daftar produk
    public function index(Request $request)
    {
        // Ambil parameter pencarian dari request
        $search = $request->get('search');

        // Mencari produk berdasarkan nama_produk atau kode_produk jika ada query pencarian
        if ($search) {
            $produk = Produk::where('nama_produk', 'like', "%{$search}%")
                ->orWhere('kode_produk', 'like', "%{$search}%")
                ->latest()
                ->paginate(10);
        } else {
            $produk = Produk::latest()->paginate(10); // Mendapatkan data produk tanpa filter
        }
       

        return view('produk.index', compact('produk'));
    }

    // Menampilkan form untuk menambah produk
    public function create()
    {
        $kategori = Categori::all(); // Ambil semua kategori
        return view('produk.create', compact('kategori'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori_id' => 'nullable|exists:categori,id', // Validasi kategori
            'kode_produk' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan data produk
        $produk = new Produk();
        $produk->kategori_id = $request->kategori_id; // Simpan kategori_id
        $produk->kode_produk = $request->kode_produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->deskripsi = $request->deskripsi;

        // Upload gambar
        if ($request->hasFile('gambar_produk')) {
            // Simpan gambar dan ambil path-nya
            $path = $request->file('gambar_produk')->store('produk', 'public');
            $produk->gambar_produk = $path; // Simpan path ke database
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Categori::all(); // Ambil semua kategori
        return view('produk.edit', compact('produk', 'kategori'));
    }

    // Memperbarui produk yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kategori_id' => 'nullable|exists:categori,id', // Validasi kategori
            'kode_produk' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9000',
        ]);

        // Temukan produk berdasarkan ID
        $produk = Produk::findOrFail($id);
        $produk->kategori_id = $request->kategori_id; // Update kategori_id
        $produk->kode_produk = $request->kode_produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->deskripsi = $request->deskripsi;

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar_produk')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar_produk) {
                Storage::disk('public')->delete($produk->gambar_produk);
            }

            // Simpan gambar baru dan ambil path-nya
            $path = $request->file('gambar_produk')->store('produk', 'public');
            $produk->gambar_produk = $path;
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($produk->gambar_produk) {
            Storage::disk('public')->delete($produk->gambar_produk);
        }

        $produk->delete();

        return redirect()->route('produk.index');
    }
}
