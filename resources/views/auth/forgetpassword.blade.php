@extends('auth.layouts.index')

@section('title', 'Lupa Kata Sandi')

@section('content')
<style>

body, html {
       height: 100%;
       margin: 0;
       padding: 0;
       /* background-image: url('/images/bacground.jpeg'); Ganti dengan jalur gambar latar belakang */
       background-size: cover;
       background-position: center;
       background-repeat: no-repeat;
   }
   /* Tambahkan CSS forget password yang sudah kita buat */
   .forget-password-form {
       max-width: 400px;
       margin: 0 auto;
       padding: 20px;
       background-color: #ffffff;
       border-radius: 10px;
       box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   }

   .forget-password-form .form-group {
       margin-bottom: 15px;
   }

   .forget-password-form .btn-primary {
       width: 100%;
   }

   .forget-logo img {
       max-width: 75%; /* Ukuran maksimum logo 150px */
       height: auto;     /* Sesuaikan tinggi logo secara proporsional */
       display: block;
       margin: 0 auto;   /* Tempatkan logo di tengah */
   }

</style>

<div class="sufee-login d-flex align-content-center flex-wrap" style="background-color: white;">
    <div class="container">
        <div class="login-content">
            <div class="forget-logo">
                <a>
                    <!-- Pastikan jalur gambar benar -->
                    <img class="align-content" src="{{ asset('images/Glowtech2.png') }}" alt="ASM Logistics">
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Tambahkan kelas untuk form forget password -->
            <div class="forget-password-form">
                <form method="POST" action="{{ route('forget.password.post') }}">
                    @csrf
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan alamat email Anda" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Tautan Reset Kata Sandi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
