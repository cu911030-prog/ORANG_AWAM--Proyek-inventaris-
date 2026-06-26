<!DOCTYPE html>
<html>
<body>
    <h1>Tambah Barang Baru</h1>

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
        
        <label>Kategori:</label><br>
        <select name="kategori_id">
            <option value="1">Elektronik</option>
            <option value="2">Perabotan</option>
        </select><br><br>

        <label>Satuan:</label><br>
        <select name="satuan_id">
            <option value="1">Pcs</option>
            <option value="2">Box</option>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>