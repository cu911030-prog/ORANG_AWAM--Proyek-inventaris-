<!DOCTYPE html>
<html>
<head>
    <title>Barang Keluar</title>
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
    <h1>Transaksi Barang Keluar</h1>

    <div class="top-actions">
        <form action="{{ route('barang-keluars.index') }}" method="GET" style="display: flex; gap: 8px; align-items: center;">
            <input type="text" name="search" placeholder="Cari nomor transaksi atau barang..." value="{{ request('search') }}">
            <button type="submit">Cari</button>
            <a href="{{ route('barang-keluars.index') }}">Reset</a>
        </form>
        <a href="{{ route('barang-keluars.create') }}">+ Tambah Barang Keluar</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($barangKeluars->count())
        <table>
            <thead>
                <tr>
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>Jumlah Item</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangKeluars as $keluar)
                    <tr>
                        <td>{{ $keluar->nomor_transaksi }}</td>
                        <td>{{ $keluar->tanggal_keluar }}</td>
                        <td>{{ $keluar->details->sum('jumlah') }}</td>
                        <td>{{ $keluar->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada transaksi barang keluar.</p>
    @endif
</body>
</html>
