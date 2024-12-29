

    <aside id="left-panel" class="left-panel">
                <nav class="navbar navbar-expand-sm navbar-default">
                    <div id="main-menu" class="main-menu collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="@yield('menuDashboard')">
                                <a href="/dashboard"><i class="menu-icon fa fa-home"></i>Home </a>
                            </li>
                            <li class="@yield('menuPesanan')">
                                <a href="/pesanan-masuk"> <i class="menu-icon fa fa-shopping-cart"></i>Pesanan Masuk</a>
                            </li>

                            {{-- <li class="menu-title">Pengiriman</li><!-- /.menu-title --> --}}




                            @if (Auth::user()->isAdmin == 1)



                            <li class="@yield('menuProduk')">
                                <a href="/produk"> <i class="menu-icon fa fa-truck"></i>Produk</a>
                            </li>
                            <li class="@yield('menuKategori')">
                                <a href="/kategori"> <i class="menu-icon fa fa-book"></i>Kategori</a>
                            </li>
                            <li class="@yield('menuStok')">
                                <a href="/stock_produk"> <i class="menu-icon fa fa-upload"></i>Stok Produk</a>
                            </li>
                            <li class="@yield('menuUser')">
                                <a href="/mengelola-user"> <i class="menu-icon fa fa-user"></i> User</a>
                            </li>

                            @endif



                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </aside>
