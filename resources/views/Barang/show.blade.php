<!DOCTYPE html>
<html>
<head>
    <title>Detail Barang</title>
</head>
<body>
    <h1>Detail Barang</h1>

    <a href="{{ route('barang.index') }}">Kembali</a>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Kode Barang</th>
            <td>{{ $barang->kode_barang }}</td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $barang->nama_barang }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $barang->kategori->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Satuan</th>
            <td>{{ $barang->satuan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Stok</th>
            <td>{{ $barang->stok }}</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>{{ $barang->harga }}</td>
        </tr>
    </table>
</body>
</html>
