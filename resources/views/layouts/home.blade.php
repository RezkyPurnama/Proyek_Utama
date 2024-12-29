<!DOCTYPE html>
<html lang="en">

<head>
  <title>Glowtech</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="">

  <!-- CSS Links -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/user/css/vendor.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/user/css/style.css') }}">

  <!-- Font Links -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
    h1, h2, h3, h4, h5, h6 {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body>

<header>
  @include('dashboarduser.layouts.sidebar')
</header>


@yield('content')

@include('dashboarduser.layouts.footer')

<!-- Scripts -->
<script src="{{ asset('admin/user/js/jquery-1.11.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
  crossorigin="anonymous"></script>
<script src="{{ asset('admin/user/js/plugins.js') }}"></script>
<script src="{{ asset('admin/user/js/script.js') }}"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

<!-- Tambahkan SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
 $(document).on('click', '.delete-btn', function (e) {
  e.preventDefault(); // Mencegah aksi default

  var form = $(this).closest("form"); // Mendapatkan form terkait

  // Tampilkan SweetAlert2 untuk konfirmasi
  Swal.fire({
    title: "Apakah Anda yakin?",
    text: "Produk ini akan dihapus dari keranjang Anda!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, hapus!",
    cancelButtonText: "Batal"
  }).then((result) => {
    if (result.isConfirmed) {
      // Animasi centang setelah konfirmasi
      Swal.fire({
        title: "Berhasil Dihapus!",
        text: "Barang berhasil dihapus dari keranjang Anda.",
        icon: "success",
        showConfirmButton: false, // Tidak menampilkan tombol
        timer: 600, // Animasi otomatis hilang setelah 1 detik
      });

      // Kirim form untuk menghapus barang
      setTimeout(() => {
        form.submit(); // Form disubmit setelah animasi selesai
      }, 600); // Sinkron dengan timer
    }
  });
});

</script>

</body>
</html>
