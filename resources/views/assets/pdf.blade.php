<!DOCTYPE html>
<html>
<head>

    <title>Laporan Asset</title>

    <style>

        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

    </style>

</head>

<body>

<h1>Laporan Data Asset</h1>

<table>

    <thead>

        <tr>

            <th>Nama</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Status</th>

        </tr>

    </thead>

    <tbody>

        @foreach($assets as $asset)

            <tr>

                <td>
                    {{ $asset->nama_aset }}
                </td>

                <td>
                    {{ $asset->category->nama_kategori }}
                </td>

                <td>
                    {{ $asset->lokasi }}
                </td>

                <td>
                    {{ $asset->status }}
                </td>

            </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>