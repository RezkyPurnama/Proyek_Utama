@extends('dashboarduser.layouts.main')

@section('content')

<style>
/   table.table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px;
    }

    /* Header tabel */
    table.table thead {
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

    .badge.bg-red {
        background-color: #28a745; /* Hijau */
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


<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="text-primary fw-bold">Riwayat Pemesanan</h1>
        <p class="text-muted">Lihat daftar pemesanan yang telah Anda lakukan</p>
        <hr class="mx-auto w-50 border-3 border-primary">
    </div>

    <!-- Notifikasi jika tidak ada riwayat pemesanan -->
    @if ($riwayatPesanan->isEmpty())
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle-fill"></i> Anda belum memiliki riwayat pemesanan.
        </div>
    @else
        <!-- Tabel Riwayat Pemesanan -->
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatPesanan as $index => $pesanan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pesanan->transaction_id }}</td>
                                    <td class="text-truncate" style="max-width: 150px;" title="{{ $pesanan->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}">
                                        {{ $pesanan->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}
                                    </td>
                                    <td>{{ $pesanan->jumlah }}</td>
                                    <td>
                                        <span class="badge
                                            {{
                                                $pesanan->status == 'sedang_diproses' ? 'bg-warning' :
                                                ($pesanan->status == 'dalam_perjalanan' ? 'bg-primary' :
                                                ($pesanan->status == 'selesai' ? 'bg-red' :
                                                ($pesanan->status == 'cancel' ? 'bg-danger' : 'bg-secondary')))
                                            }}">
                                            {{ str_replace('_', ' ', ucfirst($pesanan->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('pesanan.detail', $pesanan->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>

                                        @if ($pesanan->status === 'dalam_perjalanan')
                                            <form action="{{ route('pesanan.ubahStatus', $pesanan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Tandai sebagai diterima">
                                                    <i class="bi bi-check-circle"></i> Diterima
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endif
</div>
@endsection
