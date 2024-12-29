@extends('auth.layouts.index')

@section('title', 'Register')
@section('content')
<style>

    .register-logo img {
        width: 60%; /* Ukuran lebar gambar tetap */
        max-width: 100%; /* Responsif agar tidak melewati kontainer */
        height: auto; /* Menjaga proporsi gambar */
    }
    </style>
<div class="sufee-login d-flex align-content-center flex-wrap" style="background-color: white;">
    <div class="container">
        <div class="login-content">
            <div class="register-logo">
                <a>
                    <!-- Pastikan jalur gambar benar -->
                    <img class="align-content" src="{{ asset('images/Glowtech2.png') }}" alt="ASM Logistics">
                </a>
            </div>
            <div class="login-form">
                <form method="POST" action="/register">
                @csrf
                    <div class="form-group">
                        <label for="floatingName" style="text-align: left; display: block;">User Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="floatingName" name="name" placeholder="User Name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label style="text-align: left; display: block;">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="floatingInput" name="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tambahkan input untuk nomor telepon -->
                    <div class="form-group">
                        <label for="floatingPhone" style="text-align: left; display: block;">Nomor Telpon</label>
                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                        id="floatingPhone" name="no_telepon" placeholder="No Telpon" value="{{ old('no_telepon') }}">
                        @error('no_telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="floatingPassword" style="text-align: left; display: block;">Password</label>
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="floatingConfirmPassword" style="text-align: left; display: block;">Confirm Password</label>
                        <input type="password" class="form-control" id="floatingConfirmPassword" name="password_confirmation" placeholder="Confirm Password">
                    </div>

                    <div class="checkbox" style="text-align: left;">
                        <label>
                            <input type="checkbox"> Agree the terms and policy
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>

                    <div class="register-link m-t-15 text-center">
                        <p>Already have account ? <a href="/login"> Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
