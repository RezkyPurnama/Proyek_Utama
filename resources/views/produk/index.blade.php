@extends('layouts.main')
@section('menuProduk', 'active')

@section('content')

<style>
    .title-product {
        font-size: 2.5rem;
        background: linear-gradient(to right, #8d8180, #0b1389);
        -webkit-background-clip: text;
        color: transparent;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        font-weight: 700;
        letter-spacing: 1px;
    }

    .title-product i {
        margin-right: 10px;
    }

     /* Menambahkan jarak pada container */
     .container-fluid {
        margin-top: 30px;
    }
</style>

<div class="container-fluid mt-4 px-4">
    <h2 class="mb-5 text-center fw-bold title-product">
        <i class="bi bi-box-seam"></i> Daftar Produk
    </h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="/produk/create" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>

        <!-- Form Pencarian -->
        <form action="{{ route('produk.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="{{ request()->get('search') }}">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
    </div>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Produk -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 12%;">Gambar</th>
                            <th style="width: 10%;">Kode Produk</th>
                            <th style="width: 12%;">Kategori</th>
                            <th>Nama Produk</th>
                            <th style="width: 15%;">Harga Produk</th>
                            <th>Deskripsi</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($produk->count() > 0)
                            @foreach ($produk as $index => $dataProduk)
                            <tr>
                                <td class="text-center">{{ $produk->firstItem() + $index }}</td>
                                <td class="text-center">
                                    @if($dataProduk->gambar_produk)
                                        <img src="{{ asset('storage/' . $dataProduk->gambar_produk) }}" alt="Gambar Produk" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $dataProduk->kode_produk }}</td>
                                <td class="text-center">{{ $dataProduk->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
                                <td>{{ $dataProduk->nama_produk }}</td>
                                <td class="text-end" style="white-space: nowrap;">Rp {{ number_format($dataProduk->harga, 0, ',', '.') }}</td>
                                <td>{{ Str::limit($dataProduk->deskripsi, 50, '...') }}</td>
                                <td class="text-center">
                                    <a href="/produk/{{ $dataProduk->id }}/edit" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="/produk/{{ $dataProduk->id }}" method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center text-muted">Tidak ada produk yang ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $produk->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
