<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang Baru</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f8f9fa; display: flex; justify-content: center; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); width: 400px; }
        h2 { margin-top: 0; color: #333; text-align: center; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        .form-group input, .form-group select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-simpan { padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; margin-top: 10px; }
        .btn-simpan:hover { background-color: #218838; }
        .btn-kembali { display: block; text-align: center; margin-top: 15px; color: #007bff; text-decoration: none; font-size: 14px; }
        .alert-error { color: #721c24; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
        .alert-error ul { margin: 0; padding-left: 20px; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Tambah Barang Baru</h2>

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Kode Barang:</label>
                <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" required>
            </div>
            
            <div class="form-group">
                <label>Nama Barang:</label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required>
            </div>
            
            <div class="form-group">
                <label>Stok:</label>
                <input type="number" name="stok" value="{{ old('stok') }}" required>
            </div>
            
            <div class="form-group">
                <label>Harga:</label>
                <input type="number" name="harga" value="{{ old('harga') }}" required>
            </div>
            
            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Satuan:</label>
                <select name="satuan_id" required>
                    <option value="">-- Pilih Satuan --</option>
                    @foreach($satuans as $satuan)
                        <option value="{{ $satuan->id }}" {{ old('satuan_id') == $satuan->id ? 'selected' : '' }}>
                            {{ $satuan->nama_satuan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-simpan">Simpan Barang</button>
            <a href="{{ route('barang.index') }}" class="btn-kembali">← Kembali ke Daftar</a>

        </form>
    </div>

</body>
</html>