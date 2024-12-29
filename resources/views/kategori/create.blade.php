@extends('layouts.main')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-fluid mt-4 px-4" style="padding-bottom: 40px;">
    <h1 class="mb-5 text-center fw-bold text-primary">Tambah Kategori</h1>

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
            <form action="{{ route('kategori.store') }}" method="POST" class="p-4 bg-white rounded shadow-sm needs-validation" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label fw-bold">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" required>
                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback">
                        Silakan masukkan nama kategori yang valid.
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary btn-sm px-4 shadow-sm">Kembali</a>
                    <button type="submit" class="btn btn-primary btn-sm px-4 shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Validasi form menggunakan HTML5
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
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
