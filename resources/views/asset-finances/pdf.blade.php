<!DOCTYPE html>
<html>
<head>

    <title>Laporan Finance</title>

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

<h1>Laporan Finance Asset</h1>

<table>

    <thead>

        <tr>

            <th>Asset</th>
            <th>Jenis</th>
            <th>Nominal</th>
            <th>Tanggal</th>

        </tr>

    </thead>

    <tbody>

        @foreach($finances as $finance)

            <tr>

                <td>
                    {{ $finance->asset->nama_aset }}
                </td>

                <td>
                    {{ $finance->jenis_transaksi }}
                </td>

                <td>

                    Rp
                    {{ number_format($finance->nominal, 0, ',', '.') }}

                </td>

                <td>
                    {{ $finance->tanggal_transaksi }}
                </td>

            </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>