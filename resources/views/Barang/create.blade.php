<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang Baru</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f8f9fa; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); width: 400px; }
        h2 { margin-top: 0; color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        .form-group input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-simpan { padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        .btn-simpan:hover { background-color: #218838; }
        .btn-kembali { display: block; text-align: center; margin-top: 10px; color: #007bff; text-decoration: none; }
        .alert-error { color: red; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Tambah Barang</h2>

        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barang.store') }}" method="POST">
            @csrf <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" placeholder="Contoh: BRG001" value="{{ old('kode_barang') }}" required>
            </div>

            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" placeholder="Contoh: Laptop Asus" value="{{ old('nama_barang') }}" required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" placeholder="Contoh: 10" value="{{ old('stok') }}" required>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" placeholder="Contoh: 5000000" value="{{ old('harga') }}" required>
            </div>

            <button type="submit" class="btn-simpan">Simpan Data</button>
            <a href="/barang" class="btn-kembali">Kembali</a>
        </form>
    </div>

</body>
</html>