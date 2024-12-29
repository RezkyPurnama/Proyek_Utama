<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total-row {
            font-weight: bold;
            background-color: #e6e6e6;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #555;
        }

        .bukti-pembayaran img {
            width: 80px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 2px;
        }
    </style>
</head>
<body>
    <!-- Judul Laporan -->
    <h2>Laporan Pesanan Masuk</h2>

    <!-- Tabel Data Pesanan -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Pembayaran</th>
                <th>Status</th>
                <th>Bukti Pembayaran</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesananMasuk as $index => $pesanan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pesanan->transaction_id }}</td>
                <td>{{ $pesanan->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}</td>
                <td>{{ $pesanan->jumlah }}</td>
                <td>{{ $pesanan->alamat }}</td>
                <td>{{ $pesanan->telepon }}</td>
                <td>{{ $pesanan->pembayaran }}</td>
                <td>{{ ucfirst($pesanan->status) }}</td>
                <td class="bukti-pembayaran">
                    @if ($pesanan->bukti_pembayaran)
                        <img src="{{ public_path('storage/' . $pesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran">
                    @else
                        <span>Tidak Ada Bukti</span>
                    @endif
                </td>
                <td>
                    {{ number_format($pesanan->produk ? $pesanan->produk->harga * $pesanan->jumlah : 0, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
            <!-- Baris Total -->
            <tr class="total-row">
                <td colspan="9">Total</td>
                <td>
                    {{ number_format($pesananMasuk->sum(function ($pesanan) {
                        return $pesanan->produk ? $pesanan->produk->harga * $pesanan->jumlah : 0;
                    }), 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Footer Laporan -->
    <div class="footer">
        Dicetak pada: {{ now()->format('d-m-Y H:i:s') }} | Laporan Pesanan Masuk
    </div>
</body>
</html>
