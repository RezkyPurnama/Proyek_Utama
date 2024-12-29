@extends('layouts.main')
@section('menuDashboard','active')

@section('content')

<div class="content mt-4 px-4">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <!-- Total Pendapatan -->
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body d-flex justify-content-between">
                        <!-- Bagian Kiri -->
                        <div class="card-left pt-1">
                            <h3 class="mb-0 fw-r" style="font-size: 1.2rem;">
                                <span class="currency float-left mr-1">Rp</span>
                                <span class="count" id="totalPendapatan" style="font-size: 1.5rem;">{{ number_format($totalPendapatan, 0, ',', '.') }}</span>
                            </h3>
                            <p class="text-light mt-1 m-0">Pendapatan</p>
                        </div>

                        <!-- Bagian Kanan (Ikon) -->
                        <div class="card-right text-right">
                            <i class="icon fade-5 icon-lg pe-7s-cash"></i>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Order Masuk -->
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-6">
                    <div class="card-body">
                        <div class="card-left pt-1 float-left">
                            <h3 class="mb-0 fw-r">
                                <span class="count">{{ $pesananMasuk }}</span>
                            </h3>
                            <p class="text-light mt-1 m-0">Order Masuk</p>
                        </div>
                        <div class="card-right float-right text-right">
                            <i class="icon fade-5 icon-lg pe-7s-cart"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Akun -->
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body">
                        <div class="card-left pt-1 float-left">
                            <h3 class="mb-0 fw-r">
                                <span class="count">{{ $jumlahUser }}</span>
                            </h3>
                            <p class="text-light mt-1 m-0">Total Akun</p>
                        </div>
                        <div class="card-right float-right text-right">
                            <i class="icon fade-5 icon-lg pe-7s-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Produk -->
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body">
                        <div class="card-left pt-1 float-left">
                            <h3 class="mb-0 fw-r">
                                <span class="count">{{ $jumlahProduk }}</span>
                            </h3>
                            <p class="text-light mt-1 m-0">Jumlah Produk</p>
                        </div>
                        <div class="card-right float-right text-right">
                            <i class="icon fade-5 icon-lg pe-7s-box2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Penjualan Bulanan dan Harian -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <strong>Grafik Penjualan Bulanan</strong>
                </div>
                <div class="card-body">
                    <canvas id="chartPenjualanBulanan" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <strong>Grafik Penjualan Harian</strong>
                </div>
                <div class="card-body">
                    <canvas id="chartPenjualanHarian" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Login -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Detail Login</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($userDetails as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role ?? 'Pengguna'}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk grafik bulanan
    const labelsBulanan = @json($bulan);
    const dataBulanan = @json($totalPenjualanBulanan);

    // Grafik Penjualan Bulanan
    const ctxBulanan = document.getElementById('chartPenjualanBulanan').getContext('2d');
    new Chart(ctxBulanan, {
        type: 'bar',
        data: {
            labels: labelsBulanan,
            datasets: [{
                label: 'Total Penjualan Bulanan',
                data: dataBulanan,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data untuk grafik harian
    const labelsHarian = @json($tanggal);
    const dataHarian = @json($totalPenjualanHarian);

    // Grafik Penjualan Harian
    const ctxHarian = document.getElementById('chartPenjualanHarian').getContext('2d');
    new Chart(ctxHarian, {
        type: 'line',
        data: {
            labels: labelsHarian,
            datasets: [{
                label: 'Total Penjualan Harian',
                data: dataHarian,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
