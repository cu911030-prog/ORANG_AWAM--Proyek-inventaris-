<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang Keluar</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f7f7f7; }
        .alert-error { background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border: 1px solid #f5c6cb; }
        .form-section { margin-bottom: 16px; }
        .btn-add { margin-top: 8px; }
    </style>
</head>
<body>
    <h1>Tambah Barang Keluar</h1>

    <a href="{{ route('barang-keluars.index') }}">Kembali</a>

    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang-keluars.store') }}" method="POST" id="form-barang-keluar">
        @csrf

        <div class="form-section">
            <label>Nomor Transaksi</label>
            <input type="text" name="nomor_transaksi" value="{{ old('nomor_transaksi') }}" required>
        </div>

        <div class="form-section">
            <label>Tanggal Keluar</label>
            <input type="date" name="tanggal_keluar" value="{{ old('tanggal_keluar', date('Y-m-d')) }}" required>
        </div>

        <div class="form-section">
            <label>Keterangan</label>
            <textarea name="keterangan">{{ old('keterangan') }}</textarea>
        </div>

        <div class="form-section">
            <table id="items-table">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Stok Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="items[0][barang_id]" class="barang-select" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}" data-stok="{{ $barang->stok }}">{{ $barang->kode_barang }} - {{ $barang->nama_barang }} ({{ $barang->satuan->nama ?? '' }})</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="items[0][jumlah]" class="jumlah-input" min="1" value="1" required></td>
                        <td class="stok-display">-</td>
                        <td><button type="button" class="btn-remove">Hapus</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="btn-add-item" class="btn-add">Tambah Baris</button>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <script>
        const itemsTable = document.querySelector('#items-table tbody');
        const btnAddItem = document.querySelector('#btn-add-item');

        function updateStokDisplay(row) {
            const select = row.querySelector('.barang-select');
            const stokDisplay = row.querySelector('.stok-display');
            const selectedOption = select.options[select.selectedIndex];
            stokDisplay.textContent = selectedOption.dataset.stok || '-';
        }

        function createRow(index) {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <select name="items[${index}][barang_id]" class="barang-select" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}" data-stok="{{ $barang->stok }}">{{ $barang->kode_barang }} - {{ $barang->nama_barang }} ({{ $barang->satuan->nama ?? '' }})</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="items[${index}][jumlah]" class="jumlah-input" min="1" value="1" required></td>
                <td class="stok-display">-</td>
                <td><button type="button" class="btn-remove">Hapus</button></td>
            `;

            row.querySelector('.barang-select').addEventListener('change', () => updateStokDisplay(row));
            row.querySelector('.btn-remove').addEventListener('click', () => row.remove());

            return row;
        }

        btnAddItem.addEventListener('click', () => {
            const index = itemsTable.querySelectorAll('tr').length;
            const row = createRow(index);
            itemsTable.appendChild(row);
        });

        document.querySelectorAll('.barang-select').forEach(select => {
            select.addEventListener('change', () => updateStokDisplay(select.closest('tr')));
        });

        document.querySelectorAll('.btn-remove').forEach(button => {
            button.addEventListener('click', () => button.closest('tr').remove());
        });
    </script>
</body>
</html>
