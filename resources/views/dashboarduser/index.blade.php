@extends('dashboarduser.layouts.main')
@section('menuKontak', 'active')
@section('content')

<style>


    /* Custom Hover Button Effect */
.hover-custom:hover {
    background-color: #ff5722; /* Warna hover */
    color: white; /* Mengubah warna teks saat hover */
    transform: scale(1.05); /* Efek zoom */
    transition: all 0.3s ease-in-out;
}




@keyframes fadeInUp {
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}



/* Card Layout */
.card-body {
    padding: 1.5rem;
}

.rating {
    margin-bottom: 15px;
}

.card-title {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Membatasi maksimal 2 baris */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis; /* Menambahkan ... jika teks terlalu panjang */
}

.harga h2 {
    font-size: 1.5rem; /* Ukuran font untuk harga */
    font-weight: bold;
}

.stok h4 {
    color: #333333; /* Warna abu gelap */
}

/* Responsive Styling */
@media (max-width: 576px) {
    .d-flex {
        flex-direction: column;
        text-align: left;
    }
    .harga, .stok {
        margin-bottom: 0.5rem;
    }
}

/* Styling untuk Dropdown (Optional jika menggunakan menu dropdown di header) */
.navbar {
    position: relative;
    z-index: 1000;  /* Navbar lebih rendah dari dropdown */
}

.dropdown-menu {
    position: absolute;
    z-index: 1050; /* Dropdown berada di atas navbar */
}

/* Tombol dengan efek hover */
.btn-cart:hover {
    background-color: #c79a4d; /* Warna sedikit lebih gelap */
    transform: scale(1.05);
}

</style>

    <!-- Banner di atas Skincare -->
    <section id="banner" style="background: #F9F3EC;">
        <div class="container">
            <div class="swiper main-swiper">
                <div class="swiper-wrapper">

                    <!-- Banner Slide 1 -->
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <!-- Image Wrapper -->
                            <div class="img-wrapper col-md-5">
                                <img src="{{ asset('images/banner 2.png') }}" class="img-fluid rounded-4">
                            </div>
                            <!-- Content Wrapper -->
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <div class="secondary-font text-primary text-uppercase mb-4">Skincare dengan produk berkualitas</div>
                                <h2 class="banner-title display-1 fw-normal">Promo Skincare Terbaik!</h2>
                                <p class="text-secondary fs-5 mb-4">Diskon hingga 50% untuk produk pilihan</p>
                                <a href="{{url('shop/skincare')}}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    Belanja Sekarang
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Banner Slide 2 -->
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <!-- Image Wrapper -->
                            <div class="img-wrapper col-md-5">
                                <img src="{{ asset('images/banner 1.png') }}" class="img-fluid rounded-4">
                            </div>
                            <!-- Content Wrapper -->
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20% off</div>
                                <h2 class="banner-title display-1 fw-normal">Promo Skincare Terbaik! <span class="text-primary">The best Skincare</span></h2>
                                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    Belanja Sekarang
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Banner Slide 3 -->
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <!-- Image Wrapper -->
                            <div class="img-wrapper col-md-5">
                                <img src="{{ asset('images/banner 4.png') }}" class="img-fluid rounded-4">
                            </div>
                            <!-- Content Wrapper -->
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20% off</div>
                                <h2 class="banner-title display-1 fw-normal">Promo Skincare Terbaik! <span class="text-primary">Skincare terbaik</span></h2>
                                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    Belanja Sekarang
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Swiper Pagination -->
                <div class="swiper-pagination mb-5"></div>
            </div>
        </div>
    </section>


<section id="skincare" class="my-5 overflow-hidden">
    <div class="container pb-5">
        <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
            <h2 class="display-3 fw-normal">Skincare</h2>
        </div>

        <div class="products-carousel swiper">
            <div class="swiper-wrapper">
                @foreach ($produk->where('kategori.nama_kategori', 'Skincare') as $product)
                    <div class="swiper-slide">
                        <div class="card position-relative shadow-sm border-0">

                            <!-- Gambar Produk -->
                            <a >
                                <img src="{{ Storage::url($product->gambar_produk) }}" class="img-fluid rounded-4 w-100" alt="{{ $product->nama_produk }}">
                            </a>

                            <div class="card-body p-3">
                                <!-- Nama Produk -->
                                <a>
                                    <h3 class="card-title pt-4 m-0 ">{{ $product->nama_produk }}</h3>
                                </a>


                                <!-- Rating Produk -->
                                <div class="rating mb-3">
                                    <span class="secondary-font">
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                    </span>
                                    <span class="text-dark">5.0</span>
                                </div>

                                <!-- Harga dan Stok Produk - Diatur dalam baris yang sama -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <!-- Harga -->
                                    <div class="harga">
                                        <h2 class="text-primary m-0">
                                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                                        </h2>
                                    </div>
                                    <!-- Stok -->
                                    <div class="stok">
                                        <h4 class="text-dark m-0">
                                            Stok: {{ $product->stockproduk->stock ?? 'Tidak tersedia' }}
                                        </h4>
                                    </div>

                                </div>


                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-between mt-3">
                                    <!-- Tombol Add To Cart dengan lebar penuh -->
                                    <a href="{{url('pesan', $product->id)}}" class="btn-cart w-100 me-3 px-4 pt-3 pb-3 text-center"
                                       style="background-color: #d4a55a; color: white;">
                                        <h5 class="text-uppercase m-0">Add To Cart</h5>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>



<!-- Informasi Pengantar di Atas Banner -->
<section id="intro" class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <iconify-icon icon="mdi:leaf" class="display-2" style="color: #198754;"></iconify-icon>
                <h4 class="fw-bold mt-3">Produk Alami</h4>
                <p>Kami menyediakan skincare berbahan alami untuk kulit yang sehat dan bercahaya.</p>
            </div>
            <div class="col-md-4 mb-4">
                <iconify-icon icon="mdi:tag-heart" class="display-2" style="color: #dc3545;"></iconify-icon>
                <h4 class="fw-bold mt-3">Promo Spesial</h4>
                <p>Nikmati diskon besar-besaran hingga 50% untuk produk favorit Anda.</p>
            </div>
            <div class="col-md-4 mb-4">
                <iconify-icon icon="mdi:star-circle" class="display-2" style="color: #ffc107;"></iconify-icon>
                <h4 class="fw-bold mt-3">Kualitas Terbaik</h4>
                <p>Produk kami telah teruji dan direkomendasikan oleh para ahli kecantikan.</p>
            </div>
        </div>
    </div>
</section>


<section id="cosmetic" class="my-5 overflow-hidden">
    <div class="container pb-5">
        <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
            <h2 class="display-3 fw-normal">Kosmetik</h2>
        </div>

        <div class="products-carousel swiper">
            <div class="swiper-wrapper">
                @foreach ($produk->where('kategori.nama_kategori', 'Kosmetik') as $product)
                    <div class="swiper-slide">
                        <div class="card position-relative shadow-sm border-0">
                            <!-- Gambar Produk -->
                            <a >
                                <img src="{{ Storage::url($product->gambar_produk) }}" class="img-fluid rounded-4 w-100" alt="{{ $product->nama_produk }}">
                            </a>

                            <div class="card-body p-3">
                                <!-- Nama Produk -->
                                <a>
                                    <h3 class="card-title pt-4 m-0 ">{{ $product->nama_produk }}</h3>
                                </a>


                                <!-- Rating Produk -->
                                <div class="rating mb-3">
                                    <span class="secondary-font">
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                    </span>
                                    <span class="text-dark">5.0</span>
                                </div>

                                <!-- Harga dan Stok Produk - Diatur dalam baris yang sama -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <!-- Harga -->
                                    <div class="harga">
                                        <h2 class="text-primary m-0">
                                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                                        </h2>
                                    </div>
                                    <!-- Stok -->
                                    <div class="stok">
                                        <h4 class="text-dark m-0">
                                            Stok: {{ $product->stockproduk->stock ?? 'Tidak tersedia' }}
                                        </h4>
                                    </div>

                                </div>


                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-between mt-3">
                                    <!-- Tombol Add To Cart dengan lebar penuh -->
                                    <a href="{{url('pesan', $product->id)}}" class="btn-cart w-100 me-3 px-4 pt-3 pb-3 text-center"
                                       style="background-color: #d4a55a; color: white;">
                                        <h5 class="text-uppercase m-0">Add To Cart</h5>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>




@endsection
