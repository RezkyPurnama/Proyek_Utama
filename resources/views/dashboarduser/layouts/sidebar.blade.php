<style>
    .main-menu {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1050;
    background-color: whitesmoke;

}

body {
    padding-top: 60px; /* Menyesuaikan dengan tinggi navbar Anda */
}
.d-flex.align-items-center.ms-auto {
    display: flex;
    justify-content: flex-start; /* Mengatur elemen agar tidak terlalu ke kanan */
    gap: 10px; /* Menambahkan jarak antar tombol */
    align-items: center; /* Menjaga kesejajaran vertikal */
    margin-right: 150px; /* Mengurangi jarak ke kanan */
}





</style>

<div class="container">
    <nav class="main-menu d-flex navbar navbar-expand-lg position-fixed">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header justify-content-center">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body d-flex justify-content-center position-relative">
                <!-- Menu utama -->
                <ul class="navbar-nav menu-list list-unstyled d-flex gap-md-3 mb-0 position-absolute start-50 translate-middle-x">
                    <li class="@yield('menuDashboarduser')"><a href="/" class="nav-link active">Home</a></li>
                    <li class="@yield('menuShop')" class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li ><a class="dropdown-item" href="/shop/skincare">Skincare</a></li>
                            <li><a class="dropdown-item" href="/shop/kosmetik">Kosmetik</a></li>
                        </ul>
                    </li>

                    <li class="@yield('menuAllproduk')" class="nav-item"><a href="{{ url('allproduk') }}" class="nav-link">All Produk</a></li>
                    <li class="@yield('menuKontak')" ><a href="{{ url('tentang') }}" class="nav-link">Tentang Kami</a></li>
                   
                </ul>
                <!-- Ikon -->
                <div class="d-flex align-items-center ms-auto">
                    <ul class="d-flex justify-content-end list-unstyled m-2 gap-1 align-items-center">
                        @if (Auth::check())
                        <!-- Profil User -->
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link mx-3 dropdown-toggle d-flex align-items-center" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <iconify-icon icon="healthicons:person" style="font-size: 1.5rem; margin-right: 5px;"></iconify-icon>
                                <span class="ms-1">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{url('riwayat-pesanan')}}">Riwayat Pemesanan</a></li>
                                <li><a class="dropdown-item" href="{{url('profile')}}">Setting</a></li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </li>

                        <!-- Keranjang -->
                        <li>
                            <a href="{{ url('keranjang') }}" class="mx-3 position-relative d-flex align-items-center">
                                <iconify-icon icon="mdi:cart" style="font-size: 1.5rem; margin-right: 5px;"></iconify-icon>
                                @if (isset($totalItems) && $totalItems > 0)
                                <span class="position-absolute badge rounded-pill"
                                    style="top: -5px; right: -10px; font-size: 0.75rem; padding: 4px 6px; background-color: red; color: white;">
                                    {{ $totalItems }}
                                </span>
                                @endif
                            </a>
                        </li>
                        @else
                        <!-- Login -->
                        <li class="nav-item mx-2"> <!-- Menambahkan margin antar item -->
                            <a href="{{ url('login') }}" class="nav-link d-flex align-items-center">
                                <span class="ms-2">Login</span>
                            </a>
                        </li>
                        <!-- Sign Up -->
                        <li class="nav-item mx-2"> <!-- Menambahkan margin antar item -->
                            <a href="{{ url('register') }}" class="nav-link d-flex align-items-center">
                                <span class="ms-2">Sign Up</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>




            </div>
        </div>

    </nav>
</div>
