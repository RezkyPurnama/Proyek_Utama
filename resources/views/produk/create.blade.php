@extends('layouts.main')

@section('title', 'Tambah Stock Produk')

@section('content')
<div class="container-fluid mt-4 px-4" style="padding-bottom: 40px;">
    <h1 class="mb-5 text-center fw-bold text-primary">Tambah Produk</h1>

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
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="p-4 bg-white rounded shadow-sm">
                @csrf

                <div class="mb-3">
                    <label for="kode_produk" class="form-label fw-bold">Kode Produk</label>
                    <input type="text" id="kode_produk" name="kode_produk" class="form-control @error('kode_produk') is-invalid @enderror" value="{{ old('kode_produk') }}" required>
                    @error('kode_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_produk" class="form-label fw-bold">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk') }}" required>
                    @error('nama_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label fw-bold">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label fw-bold">Harga</label>
                    <input type="number" step="0.01" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar_produk" class="form-label fw-bold">Gambar Produk</label>
                    <input type="file" id="gambar_produk" name="gambar_produk" class="form-control @error('gambar_produk') is-invalid @enderror">
                    @error('gambar_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-sm px-4 shadow-sm">Kembali</a>
                    <button type="submit" class="btn btn-primary btn-sm px-4 shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
