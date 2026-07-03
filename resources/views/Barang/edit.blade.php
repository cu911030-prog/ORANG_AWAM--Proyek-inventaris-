<!DOCTYPE html>
<html>
<body>
    <h1>Edit Barang</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT') 
        
        <label>Kode Barang:</label><br>
        <input type="text" name="kode_barang" value="{{ $barang->kode_barang }}"><br><br>
        
        <label>Nama Barang:</label><br>
        <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}"><br><br>
        
        <label>Stok:</label><br>
        <input type="number" name="stok" value="{{ $barang->stok }}"><br><br>
        
        <label>Harga:</label><br>
        <input type="number" name="harga" value="{{ $barang->harga }}"><br><br>
        
        <!-- PENGUBAHAN KATEGORI (DINAMIS & SELECTED) -->
        <label>Kategori:</label><br>
        <select name="kategori_id" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select><br><br>

        <!-- PENGUBAHAN SATUAN (DINAMIS & SELECTED) -->
        <label>Satuan:</label><br>
        <select name="satuan_id" required>
            <option value="">-- Pilih Satuan --</option>
            @foreach($satuans as $satuan)
                <option value="{{ $satuan->id }}" {{ $barang->satuan_id == $satuan->id ? 'selected' : '' }}>
                    {{ $satuan->nama_satuan }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>