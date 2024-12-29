@extends('dashboarduser.layouts.main')

@section('content')

<style>
   .bg-success {
        background-color: #218838 !important;
        color: #ffffff !important;
        font-weight: bold;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-bottom: 2px solid #e9ecef;
        text-align: center;
        font-weight: bold;
        font-size: 1.25rem;
    }

    .card-footer {
        background-color: #f8f9fa;
        border-top: 2px solid #e9ecef;
    }

    .badge {
        padding: 8px 12px;
        font-size: 0.9rem;
        border-radius: 20px;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #343a40;
    }

    .btn {
        border-radius: 25px;
        font-weight: bold;
    }

    .text-muted {
        font-size: 1rem;
    }
</style>

<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="text-primary">Detail Pesanan</h1>
        <p class="text-muted">Informasi detail tentang pesanan Anda</p>
    </div>

    <!-- Detail Pesanan -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="bi bi-receipt"></i> Detail Pesanan
            </h5>
        </div>
        <div class="card-body px-4 py-4">
            <div class="row mb-3">
                <div class="col-sm-4"><strong>ID Transaksi:</strong></div>
                <div class="col-sm-8">{{ $pesanan->transaction_id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4"><strong>Produk:</strong></div>
                <div class="col-sm-8">{{ $pesanan->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4"><strong>Jumlah:</strong></div>
                <div class="col-sm-8">{{ $pesanan->jumlah }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4"><strong>Total Harga:</strong></div>
                <div class="col-sm-8">Rp {{ number_format($pesanan->produk->harga * $pesanan->jumlah, 0, ',', '.') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4"><strong>Status:</strong></div>
                <div class="col-sm-8">
                    <span class="badge
                        {{
                            $pesanan->status == 'pending' ? 'bg-warning text-dark' :
                            ($pesanan->status == 'paid' ? 'bg-primary text-white' :
                            ($pesanan->status == 'shipped' ? 'bg-info text-dark' :
                            ($pesanan->status == 'completed' ? 'bg-success text-white' :
                            ($pesanan->status == 'cancelled' ? 'bg-danger text-white' : 'bg-secondary text-white'))))
                        }}">
                        {{ ucfirst($pesanan->status) }}
                    </span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4"><strong>Alamat Pengiriman:</strong></div>
                <div class="col-sm-8">{{ $pesanan->alamat }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4"><strong>Telepon:</strong></div>
                <div class="col-sm-8">{{ $pesanan->telepon }}</div>
            </div>
            <div class="row">
                <div class="col-sm-4"><strong>Tanggal Pemesanan:</strong></div>
                <div class="col-sm-8">{{ $pesanan->created_at->format('d M Y H:i') }}</div>
            </div>
        </div>
        <div class="card-footer text-end py-3">
            <a href="{{ route('riwayat.pesanan') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

@endsection
