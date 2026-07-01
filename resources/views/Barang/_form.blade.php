@php
    $kategoriOptions = $kategoriOptions ?? [];
    $satuanOptions = $satuanOptions ?? [];
@endphp

<div class="mb-3">
    <label for="kode_barang" class="form-label">Kode Barang</label>
    <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="{{ old('kode_barang', $barang->kode_barang ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="nama_barang" class="form-label">Nama Barang</label>
    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="kategori_id" class="form-label">Kategori</label>
    <select name="kategori_id" id="kategori_id" class="form-select" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoriOptions as $kategori)
            <option value="{{ $kategori['id'] }}" {{ old('kategori_id', $barang->kategori_id ?? '') == $kategori['id'] ? 'selected' : '' }}>
                {{ $kategori['nama'] }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="satuan_id" class="form-label">Satuan</label>
    <select name="satuan_id" id="satuan_id" class="form-select" required>
        <option value="">-- Pilih Satuan --</option>
        @foreach($satuanOptions as $satuan)
            <option value="{{ $satuan['id'] }}" {{ old('satuan_id', $barang->satuan_id ?? '') == $satuan['id'] ? 'selected' : '' }}>
                {{ $satuan['nama'] }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="stok" class="form-label">Stok</label>
    <input type="number" name="stok" id="stok" class="form-control" min="0" value="{{ old('stok', $barang->stok ?? 0) }}" required>
</div>

<div class="mb-3">
    <label for="harga" class="form-label">Harga</label>
    <input type="number" name="harga" id="harga" class="form-control" min="0" step="0.01" value="{{ old('harga', $barang->harga ?? 0) }}" required>
</div>
