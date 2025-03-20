@extends('dashboarduser.layouts.main')

@section('content')

<style>
    .custom-image {
        max-width: 100%;
        height: auto;
        max-height: 400px;
    }

    .card {
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background-color: #ffffff;
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #dead6f; /* Sama seperti warna di 'Tentang Kami' */
        color: #ffffff;
        font-size: 1.3rem;
        font-weight: 600;
        text-align: center;
        padding: 0.8rem;
    }

    .card-body {
        padding: 1.2rem;
    }

    .table-detail {
        width: 100%;
        border-collapse: collapse;
    }

    .table-detail td {
        padding: 0.6rem;
        vertical-align: middle;
        font-size: 0.9rem;
    }

    .table-detail td:first-child {
        font-weight: 600;
        color: #495057;
        width: 40%;
        white-space: nowrap;
    }

    .badge {
        padding: 0.4rem 0.8rem;
        font-size: 0.9rem;
        font-weight: 500;
        border-radius: 20px;
        text-transform: capitalize;
    }

    .btn {
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.5rem 1.2rem;
        transition: background-color 0.3s ease;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .icon {
        margin-right: 0.5rem;
        font-size: 1rem;
        vertical-align: middle;
        color: #6c757d;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #dead6f; /* Menggunakan warna yang sama dengan header */
        margin-bottom: 0.4rem;
    }

    .section-subtitle {
        font-size: 1rem;
        color: #6c757d;
    }

    .badge.bg-red {
        background-color: #28a745; /* Hijau */
        color: white;
    }
</style>

<div class="container py-3">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="section-title">Detail Pesanan</h1>
        <p class="section-subtitle">Ringkasan lengkap mengenai informasi pesanan Anda</p>
    </div>

    <!-- Detail Pesanan Card -->
    <div class="card">
        <div class="card-header">
            <i class="bi bi-receipt"></i> Informasi Pesanan
        </div>
        <div class="card-body">
            <table class="table-detail">
                <tr>
                    <td><i class="bi bi-upc icon"></i>ID Transaksi</td>
                    <td>{{ $pesanan->transaction_id }}</td>
                </tr>
                <tr>
                    <td><i class="bi bi-box-seam icon"></i>Produk</td>
                    <td>{{ $pesanan->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}</td>
                </tr>
                <tr>
                    <td><i class="bi bi-hash icon"></i>Jumlah</td>
                    <td>{{ $pesanan->jumlah }}</td>
                </tr>
                <tr>
                    <td><i class="bi bi-currency-dollar icon"></i>Total Harga</td>
                    <td>Rp {{ number_format($pesanan->produk->harga * $pesanan->jumlah, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><i class="bi bi-flag icon"></i>Status</td>
                    <td>
                        <span class="badge
                            {{
                                $pesanan->status == 'sedang_diproses' ? 'bg-warning text-dark' :
                                ($pesanan->status == 'dalam_perjalanan' ? 'bg-primary text-white' :
                                ($pesanan->status == 'selesai' ? 'bg-red text-white' :
                                ($pesanan->status == 'cancel' ? 'bg-danger text-white' : 'bg-secondary text-white')))
                            }}">
                            {{ str_replace('_', ' ', ucfirst($pesanan->status)) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><i class="bi bi-house-door icon"></i>Alamat Pengiriman</td>
                    <td>{{ $pesanan->alamat }}</td>
                </tr>
                <tr>
                    <td><i class="bi bi-telephone icon"></i>Telepon</td>
                    <td>{{ $pesanan->telepon }}</td>
                </tr>
                <tr>
                    <td><i class="bi bi-calendar-event icon"></i>Tanggal Pemesanan</td>
                    <td>{{ $pesanan->created_at->format('d M Y H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('riwayat.pesanan') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

@endsection
