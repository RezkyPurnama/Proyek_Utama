@extends('dashboarduser.layouts.main')
@section('menuAllproduk', 'active')
@section('content')

<style>

    #banner-skincare .banner-content a:hover {
        background-color: #ff6347; /* Warna lebih terang saat hover */
        transform: scale(1.1); /* Efek sedikit membesar saat hover */
    }


    #intro .col-md-4 {
        text-align: center;
    }

    #intro h4 {
        font-size: 1.2rem;
        font-weight: 600;
    }

    #intro .iconify-icon {
        font-size: 4rem;
        margin-bottom: 10px;
    }

    #intro p {
        font-size: 1rem;
        margin-top: 10px;
    }

    @media (max-width: 992px) {
        .banner-content h2 {
            font-size: 2.5rem;
        }
        .banner-content p {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 576px) {
        .banner-content h2 {
            font-size: 1.8rem;
        }
        .banner-content p {
            font-size: 1rem;
        }
        .banner-content a {
            font-size: 0.9rem;
            padding: 10px 20px;
        }

    }
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
        overflow: hidden; /* Menghilangkan teks yang lebih dari 2 baris */
        text-overflow: ellipsis; /* Tambahkan ... jika teks terlalu panjang */
    }

    .harga h2 {
        font-size: 1.5rem; /* Ukuran font untuk harga */
        font-weight: bold;
    }

    .stok h4 {
        color: #333333; /* Warna abu gelap */

    }

    @media (max-width: 576px) {
        .d-flex {
            flex-direction: column;
            text-align: left;
        }
        .harga, .stok {
            margin-bottom: 0.5rem;
        }
    }

    #banner-skincare .banner {
        width: 100%;
        height: 700px; /* Atur tinggi banner lebih kecil */
        position: relative;
    }

    #banner-skincare .banner img {
        object-fit: cover;
        height: 100%; /* Menjaga gambar memenuhi kontainer */
    }

    #banner-skincare .banner-content {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 1s forwards;
    }

    @keyframes fadeInUp {
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn-cart:hover {
        background-color: #c79a4d; /* Warna sedikit lebih gelap */
        transform: scale(1.05);
    }

    </style>

<section id="all-products" class="my-5 overflow-hidden">
    <div class="container pb-5">
        <div class="section-header d-md-flex justify-content-center align-items-center mb-3">
            <h2 class="display-3 fw-normal">All Produk</h2>
        </div>

        <div class="row">
            @foreach ($produk as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card position-relative shadow-sm border-0">
                        <!-- Gambar Produk -->
                        <a>
                            <img src="{{ Storage::url($product->gambar_produk) }}" class="img-fluid rounded-4 w-100" alt="{{ $product->nama_produk }}">
                        </a>

                        <div class="card-body p-3">
                            <!-- Nama Produk -->
                            <a>
                                <h3 class="card-title pt-4 m-0">{{ $product->nama_produk }}</h3>
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

                            <!-- Harga dan Stok Produk -->
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
                                <a href="{{ url('pesan', $product->id) }}" class="btn-cart w-100 me-3 px-4 pt-3 pb-3 text-center" style="background-color: #d4a55a; color: white;">
                                    <h5 class="text-uppercase m-0">Add To Cart</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
