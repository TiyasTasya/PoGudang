<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Barang</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11pt;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

    <h2>LAPORAN DATA BARANG</h2>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th class="text-center">Satuan</th>
                <th class="text-right">Stok</th>
                <th class="text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangs as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td class="text-center">{{ strtoupper($item->satuan) }}</td>
                    <td class="text-right">{{ number_format($item->stok, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
