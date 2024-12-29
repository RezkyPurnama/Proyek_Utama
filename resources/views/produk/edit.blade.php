@extends('layouts.main')

@section('title', 'Edit Data Produk')

@section('content')
<div class="container-fluid mt-4 px-4" style="padding-bottom: 40px;">
    <h1 class="mb-5 text-center fw-bold text-primary">Edit Produk</h1>

    <!-- Pesan Validasi Error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="p-4 bg-white rounded shadow-sm">
                @method('PUT')
                @csrf

                <div class="mb-3">
                    <label for="kode_produk" class="form-label fw-bold">Kode Produk</label>
                    <input type="text" id="kode_produk" name="kode_produk" class="form-control @error('kode_produk') is-invalid @enderror" value="{{ old('kode_produk', $produk->kode_produk) }}" readonly>
                    @error('kode_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_produk" class="form-label fw-bold">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                    @error('nama_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="kategori_id" class="form-label fw-bold">Kategori</label>
                    <select name="kategori_id" id="kategori_id"
                            class="form-control @error('kategori_id') is-invalid @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}"
                                    {{ old('kategori_id', $produk->kategori_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label fw-bold">Harga</label>
                    <input type="number" step="0.01" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', $produk->harga) }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar_produk" class="form-label fw-bold">Gambar Produk</label>
                    <input type="file" id="gambar_produk" name="gambar_produk" class="form-control @error('gambar_produk') is-invalid @enderror">

                    @if ($produk->gambar_produk)
                        <div class="mt-3">
                            <label for="current_image" class="form-label">Gambar Saat Ini</label>
                            <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="Gambar Produk" class="img-fluid rounded shadow-lg" style="max-width: 150px; height: auto;">
                        </div>
                    @endif

                    @error('gambar_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-sm px-4 shadow-sm">Kembali</a>
                    <button type="submit" class="btn btn-success btn-sm px-4 shadow-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
