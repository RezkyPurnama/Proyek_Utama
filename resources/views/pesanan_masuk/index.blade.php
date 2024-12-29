@extends('layouts.main')

@section('menuPesanan', 'active') <!-- Menandakan menu Pesanan Masuk aktif -->

@section('content')

<style>
    /* Style umum untuk tabel */
    table.table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px;
    }

    /* Header tabel */
    table.table thead {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    table.table th, table.table td {
        text-align: center;
        padding: 8px;
    }

    /* Baris ganjil untuk striping */
    table.table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    /* Status Badge */
    .badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 12px;
        font-weight: 600;
        border-radius: 0.5rem;
        text-transform: capitalize;
    }

    .badge.bg-success {
        background-color: #28a745;
        color: white;
    }

    .badge.bg-warning {
        background-color: #ffc107;
        color: black;
    }

    .badge.bg-danger {
        background-color: #dc3545;
        color: white;
    }

    /* Tombol aksi */
    .btn-sm {
        font-size: 12px;
        padding: 5px 10px;
    }

    /* Tooltip untuk nama panjang */
    td.text-truncate {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    /* Gaya pagination */
    .pagination {
        justify-content: center;
    }
</style>

    <div class="container-fluid mt-4 px-4">

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tombol Cetak Laporan -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Daftar Pesanan Masuk</h2>
            <a href="{{ route('pesanan.cetak') }}" class="btn btn-primary">
                <i class="fas fa-download"></i> Cetak Laporan
            </a>
        </div>

        <!-- Tabel Daftar Pesanan -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Pembayaran</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesananMasuk as $index => $pesanan)
                                <tr class="text-center align-middle">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pesanan->transaction_id }}</td>
                                    <!-- Nama Produk dengan Truncate -->
                                    <td class="text-start text-truncate" style="max-width: 200px;" title="{{ $pesanan->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}">
                                        {{ $pesanan->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}
                                    </td>
                                    <td>{{ $pesanan->jumlah }}</td>
                                    <td>{{ $pesanan->alamat }}</td>
                                    <td>{{ $pesanan->telepon }}</td>
                                    <td>{{ $pesanan->pembayaran }}</td>
                                    <td>
                                        <span class="badge
                                            {{
                                                $pesanan->status == 'pending' ? 'bg-warning' :
                                                ($pesanan->status == 'paid' ? 'bg-primary' :
                                                ($pesanan->status == 'shipped' ? 'bg-info' :
                                                ($pesanan->status == 'completed' ? 'bg-success' :
                                                ($pesanan->status == 'cancelled' ? 'bg-danger' : 'bg-secondary'))))
                                            }}">
                                            {{ ucfirst($pesanan->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($pesanan->produk)
                                            {{ number_format($pesanan->produk->harga * $pesanan->jumlah, 0, ',', '.') }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td>
                                        @if ($pesanan->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" target="_blank" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        @else
                                            <span class="badge bg-danger">Belum Ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('pesananmasuk.update', $pesanan->id) }}" method="POST" class="d-flex flex-column align-items-center gap-2">
                                            @csrf
                                            @method('PUT')

                                            <!-- Dropdown untuk Ubah Status -->
                                            <div class="input-group mb-2" style="max-width: 200px;">
                                                <span class="input-group-text bg-light text-dark">
                                                    <i class="fas fa-sync-alt"></i>
                                                </span>
                                                <select name="status" class="form-select form-select-sm" required>
                                                    <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="paid" {{ $pesanan->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                                    <option value="shipped" {{ $pesanan->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                    <option value="completed" {{ $pesanan->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="cancelled" {{ $pesanan->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </div>

                                            <!-- Tombol Simpan -->
                                            <button type="submit" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                                <i class="fas fa-save"></i>
                                                <span>Simpan</span>
                                            </button>
                                        </form>
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">Tidak ada pesanan yang masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
