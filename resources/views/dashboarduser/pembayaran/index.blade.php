@extends('dashboarduser.layouts.main')

@section('content')
<div class="container my-4">
    <div class="row">
        <!-- Tombol Kembali -->
        <div class="col-md-12 mb-3">
            <a href="{{ url('keranjang') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Breadcrumb -->
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-2 rounded-4">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                </ol>
            </nav>
        </div>

        <!-- Card Pembayaran -->
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-4 mb-3">
                <div class="card-body p-3">
                    <h5 class="fw-bold text-primary">
                        <i class="fa fa-credit-card"></i> Pembayaran
                    </h5>

                    @if($keranjangs->count() > 0)
                        <!-- Detail Pembayaran -->
                        <p class="text-end text-muted mb-1">Tanggal Pembayaran: {{ now()->format('d-m-Y') }}</p>
                        <p><strong>Nama Pembeli: </strong>{{ Auth::user()->name }}</p>

                        <!-- Tabel Produk -->
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="text-center bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($keranjangs as $keranjang)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">
                                            <img src="{{ $keranjang->produk->gambar_produk ? Storage::url($keranjang->produk->gambar_produk) : asset('default-image.jpg') }}"
                                                 width="80"
                                                 class="rounded"
                                                 alt="Gambar Produk">
                                        </td>
                                        <td>{{ $keranjang->produk->nama_produk }}</td>
                                        <td class="text-center">{{ $keranjang->jumlah }}</td>
                                        <td class="text-end">Rp. {{ number_format($keranjang->produk->harga, 0, ',', '.') }}</td>
                                        <td class="text-end">Rp. {{ number_format($keranjang->produk->harga * $keranjang->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                    <tr class="table-light">
                                        <td colspan="5" class="text-end"><strong>Total Harga :</strong></td>
                                        <td class="text-end"><strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Form Alamat dan Metode Pembayaran -->
                        <form action="{{ route('pembayaran.proses') }}" method="POST">
                            @csrf

                            <!-- Nomor Telepon -->
                            <div class="form-group mb-3">
                                <label for="no_telepon" class="form-label"><strong>Nomor Telepon</strong></label>
                                <input type="text" name="no_telepon" id="no_telepon"
                                       class="form-control form-control-sm rounded-3"
                                       value="{{ Auth::user()->no_telepon }}"
                                       placeholder="Masukkan nomor telepon" required>
                            </div>

                            <!-- Alamat -->
                            <div class="form-group mb-3">
                                <label for="alamat" class="form-label">Alamat Pengiriman</label>
                                <textarea name="alamat" id="alamat"
                                          class="form-control form-control-sm rounded-3"
                                          rows="2"
                                          placeholder="Masukkan alamat lengkap"
                                          required></textarea>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="form-group mb-3">
                                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="metode_pembayaran"
                                        class="form-select form-select-sm rounded-3"
                                        required>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cod">Cash on Delivery</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100 rounded-pill">
                                <i class="fa fa-credit-card"></i> Proses Pembayaran
                            </button>
                        </form>
                    @else
                        <div class="alert alert-warning text-center mt-4">
                            Keranjang Anda kosong. Silakan tambahkan produk ke keranjang terlebih dahulu.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
