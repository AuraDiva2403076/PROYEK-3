<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Produk</title>
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
            background-color: #ffd4d4;
        }
        img {
            max-width: 50px;
            max-height: 50px;
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
        <h2>Laporan Produk</h2>
        <p>{{ date('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Ukuran</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Warna / Stok</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode_produk }}</td>
                    <td>
                        @if($item->gambar)
                            <img src="{{ public_path('storage/' . $item->gambar) }}" alt="gambar">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->ukuran }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>Rp{{ number_format($item->harga,0,',','.') }}</td>
                    <td>{{ $item->warna }} / {{ $item->stok }}</td>
                    <td>{{ $item->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
