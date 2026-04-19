<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f37b7b;
        }
        h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        .header {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Penjualan</h2>
        <p>{{ date('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pesanan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode_pesanan }}</td>
                    <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp{{ number_format($item->total,0,',','.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
