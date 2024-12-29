<?php

use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CekoutController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SkincareController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrderlistController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\StokProdukController;
use App\Http\Controllers\PesananMasukController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\RiwayatPesananController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Halaman depan
// Route::get('/', function () {
//     $produk = Produk::all();

//     return view('layouts.home',compact('produk'));
// });
Route::get('/', [LandingController::class, 'pelanggan']);

// Rute untuk admin dan owner
Route::middleware(['isAdmin'])->group(function () {
    // Rute yang dapat diakses oleh admin dan owner
    Route::get('/dashboard', [DashboardAdminController::class, 'index']);
    Route::get('pesanan-masuk', [PesananMasukController::class, 'index'])->name('pesananmasuk.index');
    Route::put('pesanan-masuk/{id}/update', [PesananMasukController::class, 'updateStatus'])->name('pesananmasuk.update');
    Route::get('/pesanan/cetak', [PesananMasukController::class, 'cetakLaporan'])->name('pesanan.cetak');


    // Admin hanya bisa mengakses rute ini
    Route::middleware(['admin_only'])->group(function () {
        Route::resource('/mengelola-user', UserController::class);  // Mengelola User
        Route::resource('/produk', ProdukController::class);
        Route::resource('/stock_produk', StokProdukController::class);
        Route::resource('/kategori', CategoriController::class);

    });
});


// Rute untuk kategori, produk, keranjang, dan halaman lainnya yang bisa diakses oleh semua pengguna
Route::get('/pesan/{id}', [PesananController::class, 'index']);  // Halaman pesanan


// Rute untuk kategori
Route::resource('/kategori', CategoriController::class);

// Rute untuk Keranjang
Route::post('/keranjang/tambah/{produk_id}', [KeranjangController::class, 'tambahKeKeranjang'])->name('keranjang.tambah');
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
Route::patch('/keranjang/update/{id}', [KeranjangController::class, 'updateJumlah'])->name('keranjang.updateJumlah');



// Halaman Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

// Halaman Logout
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/logout', [LoginController::class, 'logout']);

// Halaman Register
Route::get('/register', [RegisterController::class, 'register']);
Route::post('/register', [RegisterController::class, 'proses_register']);

// Halaman Forget Password
Route::get('/forgetpassword', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forgetpassword', [ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('/resetpassword/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/resetpassword', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Halaman User
Route::get('/user', [LandingController::class, 'pelanggan']);
Route::get('/shop', [LandingController::class, 'shop']);
Route::get('/tentang', [LandingController::class, 'tentang']);

Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// kategori
Route::get('/shop/skincare', [ShopController::class, 'skincare']);
Route::get('/shop/kosmetik', [ShopController::class, 'kosmetik']);
Route::get('/allproduk', [ShopController::class, 'allproduk']);

// order
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order/payment', [OrderController::class, 'pembayaran'])->name('order.payment');
Route::get('/order/success', [OrderController::class, 'paymentSuccess'])->name('order.success');
Route::get('/order/upload', [OrderController::class, 'showUploadBukti'])->name('order.upload');
Route::post('order/upload-bukti-pembayaran', [OrderController::class, 'uploadBuktiPembayaran'])->name('order.uploadBuktiPembayaran');

Route::get('/riwayat-pesanan', [RiwayatPesananController::class, 'index'])->name('riwayat.pesanan');
Route::post('/riwayat-pesanan/{id}/ubah-status', [RiwayatPesananController::class, 'ubahStatus'])->name('pesanan.ubahStatus');
Route::get('/riwayat-pesanan/{id}/detail', [RiwayatPesananController::class, 'detail'])
    ->name('pesanan.detail');










