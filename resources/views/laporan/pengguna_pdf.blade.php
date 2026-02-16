<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengguna</title>
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
        <h2>Laporan Pengguna</h2>
        <p>{{ date('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pengguna</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Tanggal Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->kode_pengguna }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->no_telepon ?? '-' }}</td>
                    <td>{{ $user->alamat ?? '-' }}</td>
                    <td>
                        @if($user->foto)
                            <img src="{{ public_path('storage/' . $user->foto) }}" alt="foto">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $user->tanggal_bergabung ? \Carbon\Carbon::parse($user->tanggal_bergabung)->format('d M Y') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
