@extends('layouts.main')

@section('title', 'Edit Data User')

@section('content')
<div class="container-fluid mt-4 px-5">
    <h1 class="mb-5">Edit Data User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mengelola-user.update', $user->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            <div class="invalid-feedback">
                Silakan masukkan nama lengkap yang valid.
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            <div class="invalid-feedback">
                Silakan masukkan email yang valid.
            </div>
        </div>

        <div class="mb-3">
            <label for="no_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}" required>
            <div class="invalid-feedback">
                Silakan masukkan nomor telepon yang valid.
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password </label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            <div class="invalid-feedback">
                Silakan masukkan password jika ingin mengubah.
            </div>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
            <div class="invalid-feedback">
                Silakan masukkan konfirmasi password yang sesuai.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
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
