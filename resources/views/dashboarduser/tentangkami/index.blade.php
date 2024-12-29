@extends('dashboarduser.layouts.main')

@section('content')


<style>
    .custom-image {
    max-width: 100%;
    height: auto;
    max-height: 400px;
}

</style>
<div class="container my-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold glow-effect text-primary">Tentang GlowTech</h1>
        <p class="lead text-muted">Skincare dan Kosmetik untuk Kulit Sehat dan Bersinar</p>
        <hr class="mx-auto w-50 border-3 border-primary">
    </div>

    <!-- Content Section -->
    <div class="row align-items-center">
        <!-- Text Content -->
        <div class="col-lg-7 mb-4">
            <p class="text-muted lh-lg" style="font-size: 1.1rem;">
                GlowTech adalah brand skincare dan kosmetik yang mengutamakan kualitas dan inovasi untuk mendukung kulit sehat dan bercahaya. Dengan memadukan teknologi modern dan bahan-bahan alami pilihan, GlowTech menghadirkan produk yang aman, efektif, dan terjangkau untuk berbagai kebutuhan kulit.
            </p>
            <p class="text-muted lh-lg" style="font-size: 1.1rem;">
                Setiap produk dirancang dengan teliti untuk memberikan perawatan terbaik, mulai dari rutinitas harian hingga solusi untuk masalah kulit spesifik. Dengan fokus pada hasil yang nyata, GlowTech membantu menciptakan kulit yang sehat, memancarkan kecantikan, dan meningkatkan kepercayaan diri.
            </p>
            <p class="text-muted lh-lg" style="font-size: 1.1rem;">
                GlowTech percaya bahwa kecantikan sejati dimulai dari kulit yang sehat. Dengan beragam program edukasi dan panduan perawatan, GlowTech hadir sebagai mitra terpercaya dalam perjalanan perawatan kulit Anda.
            </p>
        </div>

        <!-- Image Section -->
        <div class="col-lg-5">
            <div class="text-center">
                <img src="{{ asset('images/Glowtech.png') }}" alt="GlowTech Products" class="img-fluid rounded shadow-lg border border-primary custom-image">

            </div>
        </div>
    </div>
</div>
@endsection
