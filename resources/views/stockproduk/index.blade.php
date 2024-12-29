@extends('layouts.main')
@section('menuStok', 'active')
@section('content')

<style>
    .title-stock {
        font-size: 2.5rem;
        background: linear-gradient(to right, #0b8d89, #0b1389);
        -webkit-background-clip: text;
        color: transparent;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        font-weight: 700;
        letter-spacing: 1px;
    }

    .title-stock i {
        margin-right: 10px;
    }

    /* Menambahkan jarak pada container */
    .container-fluid {
        margin-top: 30px;
    }
</style>

<div class="container-fluid mt-4 px-4">
    <h2 class="mb-5 text-center fw-bold title-stock">
        <i class="bi bi-boxes"></i> Daftar Stok Produk
    </h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('stock_produk.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Stok Produk
        </a>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('stock_produk.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="{{ request()->search }}">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
    </div>

    <!-- Notifikasi Stok Rendah -->
    @if ($lowStockProducts->isNotEmpty())
        <div class="alert alert-warning">
            <strong>Perhatian!</strong> Beberapa produk memiliki stok rendah:
            <ul>
                @foreach ($lowStockProducts as $product)
                    <li>{{ $product->produk->nama_produk ?? 'Produk tidak ditemukan' }} (Stok: {{ $product->stock }})</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Notifikasi Sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Stok Produk -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 12%;">Nama Produk</th>
                            <th style="width: 10%;">Stok</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stockProduks as $index => $dataStok)
                            <tr>
                                <td class="text-center">{{ $stockProduks->firstItem() + $index }}</td>
                                <td>{{ $dataStok->produk->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                                <td class="text-center">{{ $dataStok->stock }}</td>
                                <td class="text-center">
                                    <a href="{{ route('stock_produk.edit', $dataStok->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('stock_produk.destroy', $dataStok->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada stok produk yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $stockProduks->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Konfirmasi Hapus
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            if (confirm('Apakah Anda yakin ingin menghapus stok produk ini?')) {
                this.closest('form').submit();
            }
        });
    });
</script>
@endsection
