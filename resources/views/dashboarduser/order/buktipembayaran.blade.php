@extends('dashboarduser.layouts.main')

@section('content')

<style>
    body {
        background-color: #f9f9f9;
    }

    .container {
        max-width: 800px;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        border: none;
    }

    .card-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-bottom: 4px solid #004094;
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745, #218838);
        border: none;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #218838, #1e7e34);
        transform: scale(1.05);
    }

    .alert-info {
        background: #e9f5ff;
        border-left: 6px solid #007bff;
        color: #0056b3;
        border-radius: 8px;
    }

    .alert-info p {
        font-size: 1.1rem;
    }

    .note-box {
        background-color: #fff3cd; /* Orange muda */
        border: 2px solid #ffeeba; /* Orange terang */
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
        color: #856404; /* Warna teks untuk kontras */
        font-size: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .note-box strong {
        color: #d39e00; /* Aksen orange yang lebih gelap */
    }

    .img-fluid {
        transition: transform 0.3s ease;
    }

    .img-fluid:hover {
        transform: scale(1.05);
    }

    .invalid-feedback {
        font-size: 0.9rem;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center mb-4 font-weight-bold" style="color: #333;">Upload Bukti Pembayaran</h2>

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
                <strong>Silahkan Kirim ke Nomor DANA:</strong> 087767278357
            @elseif(session('pembayaran') == 'Gopay')
                <strong>Silahkan Kirim ke Nomor Gopay :</strong> 087767278357
            @else
                Metode pembayaran tidak valid.
            @endif
        </p>
    </div>

    <!-- Note -->
    <div class="note-box">
        <p><strong>Catatan:</strong> Pastikan bukti pembayaran Anda jelas dan sesuai dengan metode pembayaran yang dipilih. Ukuran file maksimum adalah 5MB.</p>
    </div>

    <!-- Form Upload Bukti Pembayaran -->
    <div class="card shadow-lg mb-5">
        <div class="card-header text-white">
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
