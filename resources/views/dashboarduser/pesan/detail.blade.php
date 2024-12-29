@extends('dashboarduser.layouts.main')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ url('user') }}" class="btn btn-outline-primary rounded-pill"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>

        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-3 rounded-4">
                    <li class="breadcrumb-item"><a href="{{ url('user') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama_produk ?? 'Produk Tidak Ditemukan' }}</li>
                </ol>
            </nav>
        </div>

        @if ($produk && isset($produk->gambar_produk))
        <div class="col-md-12">
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            <img src="{{ $produk->gambar_produk ? Storage::url($produk->gambar_produk) : asset('produk/RUu54u9wrlkpdysb8gMGoBUHOtTRw0XZteITxxjU.png') }}"
                                 class="img-fluid rounded-4 shadow-sm mb-3"
                                 style="max-height: 400px; object-fit: cover;"
                                 alt="Produk Image">
                        </div>
                        <div class="col-md-6">
                            <h2 class="fw-bold mb-4">{{ $produk->nama_produk }}</h2>
                            <table class="table table-striped table-bordered mt-3">
                                <tbody>
                                    <tr>
                                        <td><i class="fa fa-tag text-primary me-2"></i>Harga</td>
                                        <td class="fw-semibold">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-cubes text-success me-2"></i>Stok</td>
                                        <td>{{ $produk->stockproduk->stock ?? 'Stok tidak tersedia' }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-info-circle text-info me-2"></i>Keterangan</td>
                                        <td>{{ $produk->deskripsi }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-cart-plus text-warning me-2"></i>Jumlah Pesan</td>
                                        <td>
                                            <form method="POST" action="{{ route('keranjang.tambah', $produk->id) }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <input type="number"
                                                           name="jumlah_pesan"
                                                           class="form-control mt-2 rounded-4"
                                                           placeholder="Masukkan jumlah"
                                                           required
                                                           min="1"
                                                           max="{{ $produk->stockproduk->stock }}"
                                                           value="1">
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-3 w-100 rounded-pill shadow">
                                                    <i class="fa fa-shopping-cart"></i> Masukkan Keranjang
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-12">
            <div class="alert alert-danger text-center rounded-4 p-4 shadow-sm">
                <strong>Produk tidak ditemukan atau gambar tidak tersedia!</strong>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
