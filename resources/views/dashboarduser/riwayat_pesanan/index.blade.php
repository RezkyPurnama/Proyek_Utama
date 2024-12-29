@extends('dashboarduser.layouts.main')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="text-primary fw-bold">Riwayat Pemesanan</h1>
        <p class="text-muted">Lihat daftar pemesanan yang telah Anda lakukan</p>
    </div>

    <!-- Notifikasi jika tidak ada riwayat pemesanan -->
    @if ($riwayatPesanan->isEmpty())
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle-fill"></i> Anda belum memiliki riwayat pemesanan.
        </div>
    @else
        <!-- Tabel Riwayat Pemesanan -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Daftar Riwayat Pemesanan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatPesanan as $index => $pesanan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pesanan->transaction_id }}</td>
                                    <!-- Nama Produk dengan Elipsis -->
                                    <td class="text-truncate" style="max-width: 150px;" title="{{ $pesanan->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}">
                                        {{ $pesanan->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}
                                    </td>
                                    <td>{{ $pesanan->jumlah }}</td>
                                    <!-- Status dengan Warna Dinamis -->
                                    <td>
                                        <span class="badge
                                            {{
                                                $pesanan->status == 'pending' ? 'bg-warning text-dark' :
                                                ($pesanan->status == 'paid' ? 'bg-primary' :
                                                ($pesanan->status == 'shipped' ? 'bg-info text-dark' :
                                                ($pesanan->status == 'completed' ? 'bg-success' :
                                                ($pesanan->status == 'cancelled' ? 'bg-danger' : ''))))
                                            }}">
                                            {{ ucfirst($pesanan->status) }}
                                        </span>
                                    </td>
                                    <!-- Total Harga -->
                                    <td>
                                        @if ($pesanan->produk)
                                            <span class="fw-bold">Rp {{ number_format($pesanan->produk->harga * $pesanan->jumlah, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-muted">0</span>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="bi bi-calendar-check"></i> {{ $pesanan->created_at->format('d M Y H:i') }}
                                    </td>
                                    <!-- Aksi -->
                                    <td>
                                        <a href="{{ route('pesanan.detail', $pesanan->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>

                                        @if ($pesanan->status === 'shipped')
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
