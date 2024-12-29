<?php

namespace App\Http\Controllers;

use App\Models\Categori; // Pastikan model Categori diimport
use Illuminate\Http\Request;

class CategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Ambil parameter pencarian dari request
    $search = $request->get('search');

    // Mencari kategori berdasarkan nama_kategori jika ada query pencarian
    if ($search) {
        $kategoris = Categori::where('nama_kategori', 'like', "%{$search}%")->paginate(10);
    } else {
        $kategoris = Categori::paginate(10); // Mendapatkan data kategori tanpa filter
    }

    return view('kategori.index', compact('kategoris', 'search'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create'); // Menampilkan form tambah kategori
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Menyimpan data kategori
        Categori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Categori::findOrFail($id); // Mencari kategori berdasarkan ID
        return view('kategori.show', compact('kategori')); // Menampilkan detail kategori
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Categori::findOrFail($id); // Mencari kategori berdasarkan ID
        return view('kategori.edit', compact('kategori')); // Menampilkan form edit kategori
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Mencari dan memperbarui kategori
        $kategori = Categori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Categori::findOrFail($id); // Mencari kategori berdasarkan ID
        $kategori->delete(); // Menghapus kategori

        return redirect()->route('kategori.index');
    }
}
