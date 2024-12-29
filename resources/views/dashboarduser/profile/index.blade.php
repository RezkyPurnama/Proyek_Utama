@extends('dashboarduser.layouts.main')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">Profil Saya</h1>
        <p class="text-muted">Kelola informasi pribadi Anda dengan mudah</p>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Profile Form -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" placeholder="Masukkan nama Anda">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" placeholder="Masukkan email Anda">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-3">
                    <label for="no_telepon" class="form-label fw-semibold">Nomor Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror"
                        value="{{ old('no_telepon', $user->no_telepon) }}" placeholder="Masukkan nomor telepon Anda">
                    @error('no_telepon')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="/" class="btn btn-secondary btn-sm shadow-sm me-2 d-flex align-items-center justify-content-center" style="width: 10%;">Kembali</a>
                    <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
