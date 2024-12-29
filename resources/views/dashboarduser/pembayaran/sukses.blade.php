@extends('dashboarduser.layouts.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Sukses Pembayaran -->
            <div class="card shadow-sm border-0 rounded-4 text-center">
                <div class="card-body p-5">
                    <!-- Ikon Sukses -->
                    <div class="text-success mb-3">
                        <i class="fa fa-check-circle fa-5x"></i>
                    </div>

                    <!-- Pesan Sukses -->
                    <h4 class="fw-bold text-success">Pembayaran Berhasil!</h4>
                    <p class="text-muted">
                        Terima kasih telah melakukan pembayaran. Pesanan Anda sedang diproses dan akan segera dikirim ke alamat tujuan.
                    </p>

                    <!-- Detail Pembayaran -->
                    <div class="mt-4 text-start">
                        <p><strong>Tanggal Pembayaran:</strong> {{ now()->format('d-m-Y H:i') }}</p>
                        <p><strong>Nama Pembeli:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Nomor Telepon:</strong> {{ $no_telepon }}</p>
                        <p><strong>Total Pembayaran:</strong> Rp. {{ number_format($total, 0, ',', '.') }}</p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="btn btn-primary rounded-pill">
                            <i class="fa fa-home"></i> Kembali ke Beranda
                        </a>
                        <a href="{{ url('pesanan-saya') }}" class="btn btn-outline-success rounded-pill">
                            <i class="fa fa-box"></i> Lihat Pesanan Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
