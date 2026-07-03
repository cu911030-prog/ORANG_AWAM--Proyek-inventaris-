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

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <label>Kode Barang:</label><br>
        <input type="text" name="kode_barang" value="{{ old('kode_barang') }}"><br><br>
        
        <label>Nama Barang:</label><br>
        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"><br><br>
        
        <label>Stok:</label><br>
        <input type="number" name="stok" value="{{ old('stok') }}"><br><br>
        
        <label>Harga:</label><br>
        <input type="number" name="harga" value="{{ old('harga') }}"><br><br>
        
        <!-- PENGUBAHAN KATEGORI (DINAMIS) -->
        <label>Kategori:</label><br>
        <select name="kategori_id" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select><br><br>

        <!-- PENGUBAHAN SATUAN (DINAMIS) -->
        <label>Satuan:</label><br>
        <select name="satuan_id" required>
            <option value="">-- Pilih Satuan --</option>
            @foreach($satuans as $satuan)
                <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
            @endforeach
        </select><br><br>

</body>
</html>