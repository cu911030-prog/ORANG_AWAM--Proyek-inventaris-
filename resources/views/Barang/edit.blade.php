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
        @method('PUT') <label>Kode Barang:</label><br>
        <input type="text" name="kode_barang" value="{{ $barang->kode_barang }}"><br><br>
        
        <label>Nama Barang:</label><br>
        <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}"><br><br>
        
        <label>Stok:</label><br>
        <input type="number" name="stok" value="{{ $barang->stok }}"><br><br>
        
        <label>Harga:</label><br>
        <input type="number" name="harga" value="{{ $barang->harga }}"><br><br>
        
        <label>Kategori:</label><br>
        <select name="kategori_id">
            <option value="1" {{ $barang->kategori_id == 1 ? 'selected' : '' }}>Elektronik</option>
            <option value="2" {{ $barang->kategori_id == 2 ? 'selected' : '' }}>Perabotan</option>
        </select><br><br>

        <label>Satuan:</label><br>
        <select name="satuan_id">
            <option value="1" {{ $barang->satuan_id == 1 ? 'selected' : '' }}>Pcs</option>
            <option value="2" {{ $barang->satuan_id == 2 ? 'selected' : '' }}>Box</option>
        </select><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>