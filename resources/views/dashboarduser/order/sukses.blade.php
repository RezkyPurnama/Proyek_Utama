@extends('dashboarduser.layouts.main')

@section('content')
<div class="container my-5">
    <!-- Notifikasi Pembayaran Berhasil -->
    <div class="alert alert-success text-center">
        <h4 class="alert-heading fw-bold">Pembayaran Berhasil!</h4>
        <p class="text-muted">Terima kasih telah melakukan pembayaran. Pesanan Anda sedang diproses dan akan segera dikirim ke alamat tujuan.</p>
        <hr>
        <p class="mb-0">Total Pembayaran: <span class="fw-bold">Rp. {{ number_format(session('total'), 0, ',', '.') }}</span></p>
        <p class="mb-0">Metode Pembayaran: <span class="fw-bold">{{ strtoupper(session('pembayaran')) }}</span></p>
        <p class="mb-0">ID Transaksi: <span class="fw-bold">{{ session('transaction_id') }}</span></p>
    </div>

    <!-- Tombol Aksi -->
    <div class="d-flex justify-content-center mt-4 gap-3">
        <a href="{{ url('/') }}" class="btn btn-primary btn-lg px-4 py-2">
            <i class="fa fa-home"></i> Kembali ke Home
        </a>
        <a href="{{ url('riwayat-pesanan') }}" class="btn btn-outline-success btn-lg px-4 py-2 ">
            <i class="fa fa-box"></i> Lihat Pesanan Saya
        </a>
    </div>
</div>
@endsection
