<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
</head>
<body>
    <h1>Data Barang</h1>

    <form action="{{ route('barang.index') }}" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Cari kode/nama barang..." value="{{ request('search') }}">
        <button type="submit">Cari</button>
        <a href="{{ route('barang.index') }}">Reset</a>
    </form>
    @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
    @endif
    
    @if(isset($barangs) && count($barangs) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                <tr>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $barang->id) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
    @else
        <p>Tidak ada data barang ditemukan.</p>
    @endif
</body>
</html>