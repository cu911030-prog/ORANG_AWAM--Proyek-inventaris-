<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang Keluar</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.5; margin: 0; padding: 24px; color: #333; }
        h1 { margin-bottom: 16px; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background-color: #f7f7f7; text-align: left; }
        .alert-error { background-color: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 16px; border: 1px solid #f5c6cb; border-radius: 4px; }
        .form-section { margin-bottom: 16px; }
        .form-section label { display: block; margin-bottom: 6px; font-weight: 600; }
        input[type="text"], input[type="date"], textarea, select, input[type="number"] { width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 4px; }
        textarea { min-height: 100px; resize: vertical; }
        .btn-add, .btn-remove, button[type="submit"] { cursor: pointer; padding: 10px 14px; border: none; border-radius: 4px; transition: background-color .2s ease; }
        .btn-add { background-color: #007bff; color: #fff; }
        .btn-add:hover { background-color: #0069d9; }
        .btn-remove { background-color: #dc3545; color: #fff; }
        .btn-remove:hover { background-color: #c82333; }
        button[type="submit"] { background-color: #28a745; color: #fff; }
        button[type="submit"]:hover { background-color: #218838; }
        .stok-display { min-width: 90px; text-align: center; }
        .invalid { border-color: #dc3545; }
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .toolbar span { font-size: 0.95rem; color: #555; }
    </style>
</head>
<body>
    <div class="toolbar">
        <a href="{{ route('barang-keluars.index') }}">&larr; Kembali ke daftar</a>
        <span>Isi data transaksi dengan benar sebelum menyimpan.</span>
    </div>

    <h1>Tambah Barang Keluar</h1>

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
            <label for="nomor_transaksi">Nomor Transaksi</label>
            <input type="text" id="nomor_transaksi" name="nomor_transaksi" value="{{ old('nomor_transaksi', $nomorTransaksi) }}" required>
        </div>

        <div class="form-section">
            <label for="tanggal_keluar">Tanggal Keluar</label>
            <input type="date" id="tanggal_keluar" name="tanggal_keluar" value="{{ old('tanggal_keluar', date('Y-m-d')) }}" required>
        </div>

        <div class="form-section">
            <label for="keterangan">Keterangan</label>
            <textarea id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
        </div>

        <div class="form-section">
            <label>Detail Barang</label>
            <table id="items-table">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $oldItems = old('items', [['barang_id' => '', 'jumlah' => 1]]);
                    @endphp

                    @foreach ($oldItems as $index => $item)
                        @php
                            $selectedBarang = $barangs->firstWhere('id', $item['barang_id'] ?? null);
                        @endphp
                        <tr>
                            <td>
                                <select name="items[{{ $index }}][barang_id]" class="barang-select" required>
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach($barangs as $barang)
                                        <option value="{{ $barang->id }}" data-stok="{{ $barang->stok }}" {{ (string)($item['barang_id'] ?? '') === (string)$barang->id ? 'selected' : '' }}>
                                            {{ $barang->kode_barang }} - {{ $barang->nama_barang }} ({{ $barang->satuan->nama ?? '' }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="items[{{ $index }}][jumlah]" class="jumlah-input" min="1" value="{{ old('items.' . $index . '.jumlah', $item['jumlah'] ?? 1) }}" required>
                            </td>
                            <td class="stok-display">{{ $selectedBarang->stok ?? '-' }}</td>
                            <td><button type="button" class="btn-remove">Hapus</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" id="btn-add-item" class="btn-add">Tambah Baris</button>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <script>
        const barangs = @json($barangs->map(fn($barang) => [
            'id' => $barang->id,
            'label' => $barang->kode_barang . ' - ' . $barang->nama_barang . ' (' . ($barang->satuan->nama ?? '') . ')',
            'stok' => $barang->stok,
        ])->all());

        const itemsTable = document.querySelector('#items-table tbody');
        const btnAddItem = document.querySelector('#btn-add-item');

        function escapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function updateStokDisplay(row) {
            const select = row.querySelector('.barang-select');
            const stokDisplay = row.querySelector('.stok-display');
            const selectedOption = select.options[select.selectedIndex];
            stokDisplay.textContent = selectedOption?.dataset?.stok || '-';
            validateQuantity(row);
        }

        function validateQuantity(row) {
            const stok = parseInt(row.querySelector('.barang-select').selectedOptions[0]?.dataset?.stok || 0, 10);
            const jumlahInput = row.querySelector('.jumlah-input');
            const jumlah = parseInt(jumlahInput.value, 10) || 0;

            if (stok > 0 && jumlah > stok) {
                jumlahInput.classList.add('invalid');
            } else {
                jumlahInput.classList.remove('invalid');
            }
        }

        function reindexRows() {
            itemsTable.querySelectorAll('tr').forEach((row, index) => {
                row.querySelector('.barang-select').setAttribute('name', `items[${index}][barang_id]`);
                row.querySelector('.jumlah-input').setAttribute('name', `items[${index}][jumlah]`);
            });
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            const removeButtons = itemsTable.querySelectorAll('.btn-remove');
            removeButtons.forEach(button => {
                button.disabled = removeButtons.length === 1;
            });
        }

        function createRow(index, item = { barang_id: '', jumlah: 1 }) {
            const row = document.createElement('tr');
            const options = [
                '<option value="">-- Pilih Barang --</option>',
                ...barangs.map(barang => `
                    <option value="${barang.id}" data-stok="${barang.stok}" ${String(item.barang_id) === String(barang.id) ? 'selected' : ''}>
                        ${escapeHtml(barang.label)}
                    </option>
                `)
            ].join('');

            row.innerHTML = `
                <td>
                    <select name="items[${index}][barang_id]" class="barang-select" required>${options}</select>
                </td>
                <td>
                    <input type="number" name="items[${index}][jumlah]" class="jumlah-input" min="1" value="${item.jumlah ?? 1}" required>
                </td>
                <td class="stok-display">-</td>
                <td><button type="button" class="btn-remove">Hapus</button></td>
            `;

            const select = row.querySelector('.barang-select');
            const jumlahInput = row.querySelector('.jumlah-input');
            const removeButton = row.querySelector('.btn-remove');

            select.addEventListener('change', () => updateStokDisplay(row));
            jumlahInput.addEventListener('input', () => validateQuantity(row));
            removeButton.addEventListener('click', () => {
                row.remove();
                reindexRows();
            });

            return row;
        }

        btnAddItem.addEventListener('click', () => {
            const index = itemsTable.querySelectorAll('tr').length;
            const row = createRow(index);
            itemsTable.appendChild(row);
            updateRemoveButtons();
        });

        itemsTable.querySelectorAll('tr').forEach(row => {
            row.querySelector('.barang-select').addEventListener('change', () => updateStokDisplay(row));
            row.querySelector('.jumlah-input').addEventListener('input', () => validateQuantity(row));
            row.querySelector('.btn-remove').addEventListener('click', () => {
                row.remove();
                reindexRows();
            });
            updateStokDisplay(row);
        });

        updateRemoveButtons();
    </script>
</body>
</html>
