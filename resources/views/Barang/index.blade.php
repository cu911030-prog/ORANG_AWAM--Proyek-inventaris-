<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f7f7f7; }
        .actions { display: flex; gap: 8px; }
        .alert-success { background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; border: 1px solid #c3e6cb; }
        .top-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
    </style>
</head>
<body>
    <h1>Data Barang</h1>
    <a href="{{ route('barang.create') }}" style="padding: 8px 12px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 15px; font-family: Arial, sans-serif;">
    + Tambah Barang Baru
</a>

    <div class="top-actions">
        <form action="{{ route('barang.index') }}" method="GET" style="display: flex; gap: 8px; align-items: center;">
            <input type="text" name="search" placeholder="Cari kode/nama barang..." value="{{ request('search') }}">
            <button type="submit">Cari</button>
            <a href="{{ route('barang.index') }}">Reset</a>
        </form>
        <a href="{{ route('barang.create') }}">+ Tambah Barang</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(isset($barangs) && count($barangs) > 0)
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                    <tr>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ optional($barang->kategori)->nama ?? '-' }}</td>
                        <td>{{ optional($barang->satuan)->nama ?? '-' }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>{{ number_format($barang->harga, 0, ',', '.') }}</td>
                        <td class="actions">
                            <a href="{{ route('barang.edit', $barang->id) }}">Edit</a>
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                            </form>
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
