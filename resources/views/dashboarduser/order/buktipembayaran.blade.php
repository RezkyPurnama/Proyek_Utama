@extends('dashboarduser.layouts.main')

@section('content')

<style>
    
</style>
<div class="container mt-5">
    <h2 class="text-center mb-4">Upload Bukti Pembayaran</h2>

    <!-- Informasi Rekening -->
    <div class="alert alert-info mb-4 shadow-lg">
        <p class="mb-0">
            @if(session('pembayaran') == 'BRI')
                <strong>Silahkan Kirim ke Nomor Rekening BRI:</strong> 1234-5678-9012-3456
            @elseif(session('pembayaran') == 'BNI')
                <strong>Silahkan Kirim ke Nomor Rekening BNI:</strong> 9876-5432-1098-7654
            @elseif(session('pembayaran') == 'Mandiri')
                <strong>Silahkan Kirim ke Nomor Rekening Mandiri:</strong> 1111-2222-3333-4444
            @elseif(session('pembayaran') == 'BCA')
                <strong>Silahkan Kirim ke Nomor Rekening BCA:</strong> 5555-6666-7777-8888
            @elseif(session('pembayaran') == 'DANA')
                <strong>Silahkan Kirim ke Nomor DANA:</strong> 0812-3456-7890
            @elseif(session('pembayaran') == 'Gopay')
                <strong>Silahkan Kirim ke Nomor Gopay :</strong> 0812-3456-7890
            @else
                Metode pembayaran tidak valid.
            @endif
        </p>
    </div>

    <!-- Form Upload Bukti Pembayaran -->
    <div class="card shadow-lg mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Unggah Bukti Pembayaran</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('order.uploadBuktiPembayaran') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="bukti_pembayaran" class="font-weight-bold">Pilih File Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" class="form-control @error('bukti_pembayaran') is-invalid @enderror" required>
                    @error('bukti_pembayaran')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success btn-block mt-3">Kirim Bukti Pembayaran</button>
            </form>
        </div>
    </div>

    <!-- Menampilkan Bukti Pembayaran yang Sudah Diupload -->
    @if(isset($order) && $order->bukti_pembayaran)
        <div class="card shadow-lg">
            <div class="card-body text-center">
                <h3>Bukti Pembayaran yang Diupload</h3>
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded shadow-lg" style="max-width: 80%; height: auto; border: 2px solid #f1f1f1;">
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
