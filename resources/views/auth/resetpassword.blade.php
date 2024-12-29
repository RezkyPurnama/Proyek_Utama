@extends('auth.layouts.index')

@section('title', 'Reset Password')
@section('content')

<style>

    .reset-logo img {
        width: 350px; /* Ukuran lebar gambar tetap */
        max-width: 100%; /* Responsif agar tidak melewati kontainer */
        height: auto; /* Menjaga proporsi gambar */
    }

    </style>
<div class="sufee-login d-flex align-content-center flex-wrap" style="background-color: white;">
    <div class="container">
        <div class="login-content">
            <div class="reset-logo">
                <a>
                    <!-- Pastikan jalur gambar benar -->
                    <img class="align-content" src="{{ asset('images/Glowtech2.png') }}" alt="ASM Logistics">
                </a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="login-form text-left"> <!-- Tambahkan kelas text-left -->
                <form method="POST" action="{{ route('reset.password.post') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
