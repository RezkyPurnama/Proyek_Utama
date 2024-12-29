{{-- @extends('dashboarduser.layouts.main')
@section('content')

<section id="clothing" class="my-5 overflow-hidden">

    <div class="container pb-5">
        <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
            <h2 class="display-3 fw-normal">Skincare</h2>
        </div>

        <div class="products-carousel swiper">
            <div class="swiper-wrapper">
                @foreach ($produk as $product)
                    <div class="swiper-slide">
                        <div class="card position-relative shadow-sm border-0">
                            <!-- Gambar Produk -->
                            <a href="#">
                                <img src="{{ Storage::url($product->gambar_produk) }}" class="img-fluid rounded-4 w-100" alt="{{ $product->nama_produk }}">

                            </a>

                            <div class="card-body p-3">
                                <!-- Nama Produk -->
                                <a href="#">
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

                                <!-- Harga -->
                                <div class="d-flex justify-content-between mb-2">
                                    <h3 class="text-primary m-0">
                                     Rp {{ number_format($product->harga, 0, ',', '.') }}
                                    </h3>
                                </div>

                                <!-- Stok di bawah Harga -->
                                <div class="d-flex justify-content-between mb-3">
                                    <h3 class="text-primary m-0">
                                        Stok: {{ $product->stockproduk->stock ?? 'Stok tidak tersedia' }}
                                    </h3>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="{{url('pesan', $product->id)}}" class="btn-cart px-3 py-3" style="background-color: #d4a55a; color: white;">
                                        <h5 class="text-uppercase m-0">Add To Cart</h5>
                                    </a>
                                    <a href="#" class="btn-wishlist px-3 py-3">
                                        <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
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
  <section id="clothing" class="my-5 overflow-hidden">
    <div class="container pb-5">
        <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
            <h2 class="display-3 fw-normal">Cosmetic</h2>
        </div>

        <div class="products-carousel swiper">
            <div class="swiper-wrapper">
                @foreach ($produk as $product)
                    <div class="swiper-slide">
                        <div class="card position-relative">
                            <a>
                                <img src="{{ Storage::url($product->gambar_produk) }}" class="img-fluid rounded-4" alt="image">
                            </a>

                            <div class="card-body p-0">
                                <a>
                                    <h3 class="card-title pt-4 m-0">{{ $product->nama_produk }}</h3>
                                </a>

                                <div class="card-text">
                                    <span class="rating secondary-font">
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                        5.0
                                    </span>

                                    <!-- Harga dan Stok dengan jarak yang diatur -->
                                    <div class="d-flex align-items-center" style="gap: 20px;">
                                        <h3 class="secondary-font text-primary m-0">
                                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                                        </h3>
                                        <h3 class="secondary-font text-primary m-0">
                                            Stok: {{ $product->stockproduk->stock ?? 'Stok tidak tersedia' }}
                                        </h3>
                                    </div>


                                    <div class="d-flex flex-wrap mt-3">
                                        <a href="{{url('pesan', $product->id)}}" class="btn-cart me-3 px-4 pt-3 pb-3" style="background-color: #d4a55a; color: white;">
                                            <h5 class="text-uppercase m-0">Add To Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

  </section>
  <section id="foodies" class="my-5">
    <div class="container my-5 py-5">

      <div class="section-header d-md-flex justify-content-between align-items-center">
        <h2 class="display-3 fw-normal">Produk Kami</h2>

      </div>

      <div class="isotope-container row">

        <div class="item cat col-md-4 col-lg-3 my-4">
          <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            New
          </div> -->
          <div class="card position-relative">
            <a href="#"><img src="images/produk1.jpeg" class="img-fluid rounded-4" alt="image"></a>
            <div class="card-body p-0">
              <a href="#">
                <h3 class="card-title pt-4 m-0">Bedak Wardah SPF 30 ++++</h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  5.0</span>

                <h3 class="secondary-font text-primary">Rp 50.000</h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>


              </div>

            </div>
          </div>
        </div>

        <div class="item dog col-md-4 col-lg-3 my-4">
          <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            New
          </div>
          <div class="card position-relative">
            <a href="#"><img src="images/produk2.jpeg" class="img-fluid rounded-4" alt="image"></a>
            <div class="card-body p-0">
              <a href="#">
                <h3 class="card-title pt-4 m-0">Moinsturizer Glad2Glow</h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  5.0</span>

                <h3 class="secondary-font text-primary">Rp 50.000</h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>


              </div>

            </div>
          </div>
        </div>

        <div class="item dog col-md-4 col-lg-3 my-4">
          <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            New
          </div> -->
          <div class="card position-relative">
            <a href="#"><img src="images/produk3.jpeg" class="img-fluid rounded-4" alt="image"></a>
            <div class="card-body p-0">
              <a href="#">
                <h3 class="card-title pt-4 m-0">Skintific Acid Peeling 12%</h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  5.0</span>

                <h3 class="secondary-font text-primary">Rp 50.000</h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>


              </div>

            </div>
          </div>
        </div>

        <div class="item cat col-md-4 col-lg-3 my-4">

          <div class="card position-relative">
            <a href="#"><img src="images/produk5.jpeg" class="img-fluid rounded-4" alt="image"></a>
            <div class="card-body p-0">
              <a href="#">
                <h3 class="card-title pt-4 m-0">Bedak Foundation Skintific</h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  5.0</span>

                <h3 class="secondary-font text-primary">Rp 50.000</h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>


              </div>

            </div>
          </div>
        </div>

        <div class="item bird col-md-4 col-lg-3 my-4">
          <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            New
          </div> -->
          <div class="card position-relative">
            <a href="#"><img src="images/produk7.jpeg" class="img-fluid rounded-4" alt="image"></a>
            <div class="card-body p-0">
              <a href="#">
                <h3 class="card-title pt-4 m-0">Skintific Aqua Light Daily Sunscreen</h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  5.0</span>

                <h3 class="secondary-font text-primary">Rp 50.000</h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>


              </div>

            </div>
          </div>
        </div>

        <div class="item bird col-md-4 col-lg-3 my-4">
          <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            New
          </div> -->
          <div class="card position-relative">
            <a href="#"><img src="images/produk8.jpeg" class="img-fluid rounded-4" alt="image"></a>
            <div class="card-body p-0">
              <a href="#">
                <h3 class="card-title pt-4 m-0">Wardah Powder Foundasion</h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  5.0</span>

                <h3 class="secondary-font text-primary">Rp 50.000</h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>


              </div>

            </div>
          </div>
        </div>

        <div class="item dog col-md-4 col-lg-3 my-4">
          <div class="card position-relative">
            <a href="#"><img src="images/produk9.jpeg" class="img-fluid rounded-4" alt="image"></a>
            <div class="card-body p-0">
              <a href="#">
                <h3 class="card-title pt-4 m-0">Dazzle Me MakeUp Product</h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  5.0</span>

                <h3 class="secondary-font text-primary">Rp 50.000</h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>


              </div>

            </div>
          </div>
        </div>

        <div class="item cat col-md-4 col-lg-3 my-4">
          <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            New
          </div> -->
          <div class="card position-relative">
            <a href="#"><img src="images/produk10.jpeg" class="img-fluid rounded-4" alt="image"></a>
            <div class="card-body p-0">
              <a href="#">
                <h3 class="card-title pt-4 m-0">Glad2Glow Soothing  Moisturizer</h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  5.0</span>

                <h3 class="secondary-font text-primary">Rp 50.000</h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>


              </div>

            </div>
          </div>
        </div>


      </div>


    </div>
    <section id="service">
        <div class="container py-5 my-5">
          <div class="row g-md-5 pt-4">
            <div class="col-md-3 my-3">
              <div class="card">
                <div>
                  <iconify-icon class="service-icon text-primary" icon="la:shopping-cart"></iconify-icon>
                </div>
                <h3 class="card-title py-2 m-0">Free Delivery</h3>
                <div class="card-text">
                  <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 my-3">
              <div class="card">
                <div>
                  <iconify-icon class="service-icon text-primary" icon="la:user-check"></iconify-icon>
                </div>
                <h3 class="card-title py-2 m-0">100% secure payment</h3>
                <div class="card-text">
                  <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 my-3">
              <div class="card">
                <div>
                  <iconify-icon class="service-icon text-primary" icon="la:tag"></iconify-icon>
                </div>
                <h3 class="card-title py-2 m-0">Daily Offer</h3>
                <div class="card-text">
                  <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 my-3">
              <div class="card">
                <div>
                  <iconify-icon class="service-icon text-primary" icon="la:award"></iconify-icon>
                </div>
                <h3 class="card-title py-2 m-0">Quality guarantee</h3>
                <div class="card-text">
                  <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>
  </section>
  <section id="bestselling" class="my-5 overflow-hidden">
    <div class="container py-5 mb-5">

      <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
        <h2 class="display-3 fw-normal">Produk terlaris</h2>

      </div>

      <div class=" swiper bestselling-swiper">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
              New
            </div> -->
            <div class="card position-relative">
              <a href="#"><img src="images/Produk1.jpeg" class="img-fluid rounded-4" alt="image"></a>
              <div class="card-body p-0">
                <a href="#">
                  <h3 class="card-title pt-4 m-0">Bedak Wardah SPF 30 ++++ </h3>
                </a>

                <div class="card-text">
                  <span class="rating secondary-font">
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    5.0</span>

                  <h3 class="secondary-font text-primary">Rp 50.000</h3>

                  <div class="d-flex flex-wrap mt-3">
                    <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                      <h5 class="text-uppercase m-0">Add to Cart</h5>
                    </a>
                    <a href="#" class="btn-wishlist px-4 pt-3 ">
                      <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                    </a>
                  </div>


                </div>

              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
              New
            </div> -->
            <div class="card position-relative">
              <a href="#"><img src="images/produk2.jpeg" class="img-fluid rounded-4" alt="image"></a>
              <div class="card-body p-0">
                <a href="#">
                  <h3 class="card-title pt-4 m-0">Moinsturizer Glad2Glow</h3>
                </a>

                <div class="card-text">
                  <span class="rating secondary-font">
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    5.0</span>

                  <h3 class="secondary-font text-primary">Rp 50.000</h3>

                  <div class="d-flex flex-wrap mt-3">
                    <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                      <h5 class="text-uppercase m-0">Add to Cart</h5>
                    </a>
                    <a href="#" class="btn-wishlist px-4 pt-3 ">
                      <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                    </a>
                  </div>

                </div>

              </div>
            </div>
          </div>
          <div class="swiper-slide">

            <div class="card position-relative">
              <a href="#"><img src="images/produk7.jpeg" class="img-fluid rounded-4" alt="image"></a>
              <div class="card-body p-0">
                <a href="#">
                  <h3 class="card-title pt-4 m-0">Skintific Aqua Light Daily Sunscreen</h3>
                </a>

                <div class="card-text">
                  <span class="rating secondary-font">
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    5.0</span>

                  <h3 class="secondary-font text-primary">Rp 50.000</h3>

                  <div class="d-flex flex-wrap mt-3">
                    <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                      <h5 class="text-uppercase m-0">Add to Cart</h5>
                    </a>
                    <a href="#" class="btn-wishlist px-4 pt-3 ">
                      <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                    </a>
                  </div>


                </div>

              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <!-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
              New
            </div> -->
            <div class="card position-relative">
              <a href="#"><img src="images/produk8.jpeg" class="img-fluid rounded-4" alt="image"></a>
              <div class="card-body p-0">
                <a href="#">
                  <h3 class="card-title pt-4 m-0">Wardah Powder Foundasion</h3>
                </a>

                <div class="card-text">
                  <span class="rating secondary-font">
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    5.0</span>

                  <h3 class="secondary-font text-primary">Rp 50.000</h3>

                  <div class="d-flex flex-wrap mt-3">
                    <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                      <h5 class="text-uppercase m-0">Add to Cart</h5>
                    </a>
                    <a href="#" class="btn-wishlist px-4 pt-3 ">
                      <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                    </a>
                  </div>


                </div>

              </div>
            </div>
          </div>




        </div>
      </div>
      <!-- / category-carousel -->


    </div>

</section>


@endsection --}}
