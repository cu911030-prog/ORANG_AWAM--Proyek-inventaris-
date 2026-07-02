<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .navbar h2 {
            margin: 0;
            font-size: 18px;
        }
        
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info {
            color: white;
        }
        
        .logout-form {
            display: inline;
        }
        
        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Sistem Inventaris</h2>
        <div class="navbar-right">
            <div class="user-info">
                Halo, {{ Auth::user()->name }}
            </div>
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div style="padding: 0 20px;">
        <h1>Data Barang</h1>
        <a href="{{ route('barang.create') }}" style="padding: 8px 12px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 15px; font-family: Arial, sans-serif;">
        + Tambah Barang Baru
    </a>

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
    </div>
</body>
</html>