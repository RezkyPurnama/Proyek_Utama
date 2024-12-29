@extends('auth.layouts.index')

@section('title', 'Login')
@section('content')

<style>

.login-logo img {
    width: 350px; /* Ukuran lebar gambar tetap */
    max-width: 100%; /* Responsif agar tidak melewati kontainer */
    height: auto; /* Menjaga proporsi gambar */
}

</style>

<div class="sufee-login d-flex align-content-center flex-wrap" style="background-color: white;">
    <div class="container">
        <div class="login-content">

            <!-- Tambahkan session success di sini -->
            @if(session('success'))
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                     {{ session('success') }}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @endif
            <!-- Akhir dari session success -->

            <!-- Tambahkan session error di sini -->
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- Akhir dari session eror -->


            <img class="img-fluid align-content" src="images/Glowtech2.png" alt="Glowtech">



            <div class="login-form" style="text-align: left;"> <!-- Tambahkan style inline atau gunakan kelas CSS -->
                <form method="POST" action="/login">
                @csrf
                    <div class="form-group">
                        <label for="floatingInput">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="floatingInput" name="email"  placeholder="Email" value="{{ old('email')}}">
                        @error('email')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="floatingPassword">Password</label>
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                        <label class="pull-right">
                            <a href="/forgetpassword">Forgotten Password?</a>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>

                    <div class="register-link m-t-15 text-center">
                        <p>Don't have account ? <a href="/register"> Sign Up Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
