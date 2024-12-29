@extends('layouts.main')

@section('title', 'Input Data User')

@section('content')
<div class="container-fluid mt-4 px-5">
    <h1 class="mb-5">Input Data User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mengelola-user.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" id="name" placeholder="masukkan nama lengkap" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
            <div class="invalid-feedback">
                Silakan masukkan nama lengkap yang valid.
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" placeholder="masukkan email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            <div class="invalid-feedback">
                Silakan masukkan email yang valid.
            </div>
        </div>

        <div class="mb-3">
            <label for="no_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" id="no_telepon" placeholder="masukkan nomor telepon" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" value="{{ old('no_telepon') }}" required>
            <div class="invalid-feedback">
                Silakan masukkan nomor telepon yang valid.
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" placeholder="masukkan password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            <div class="invalid-feedback">
                Silakan masukkan password.
            </div>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" placeholder="masukkan confirm password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
            <div class="invalid-feedback">
                Silakan masukkan konfirmasi password.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('mengelola-user.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@section('scripts')
<script>
    // Menambahkan validasi HTML5 untuk form
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection
@endsection
