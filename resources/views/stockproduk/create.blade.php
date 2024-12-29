@extends('layouts.main')

@section('title', 'Tambah Stok Produk')

@section('content')
<div class="container-fluid mt-4 px-4" style="padding-bottom: 40px;">
    <h1 class="mb-5 text-center fw-bold text-primary">Tambah Stok Produk</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('stock_produk.store') }}" method="POST" class="p-4 bg-white rounded shadow-sm needs-validation" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="produk_id" class="form-label fw-bold">Nama Produk</label>
                    <select name="produk_id" id="produk_id" class="form-control @error('produk_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Produk</option>
                        @foreach ($produks as $produk)
                            <option value="{{ $produk->id }}">{{ Str::limit($produk->nama_produk, 30) }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Silakan pilih produk yang valid.</div>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label fw-bold">Stok</label>
                    <input type="number" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="Masukkan jumlah stok" required min="0">
                    <div class="invalid-feedback">Silakan masukkan jumlah stok yang valid.</div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('stock_produk.index') }}" class="btn btn-secondary btn-sm px-4 shadow-sm">Kembali</a>
                    <button type="submit" class="btn btn-primary btn-sm px-4 shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection
@endsection
