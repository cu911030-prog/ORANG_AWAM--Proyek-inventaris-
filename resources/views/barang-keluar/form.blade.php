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

@php
    $jsonBarangs = $barangs->map(function ($barang) {
        return [
            'id' => $barang->id,
            'label' => $barang->kode_barang . ' - ' . $barang->nama_barang . ' (' . ($barang->satuan->nama ?? '') . ')',
            'stok' => $barang->stok,
        ];
    })->all();
@endphp

<script>
    const barangs = @json($jsonBarangs);

    const itemsTable = document.querySelector('#items-table tbody');
    const btnAddItem = document.querySelector('#btn-add-item');

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
                    ${barang.label}
                </option>
            `)
        ].join('');

        row.innerHTML = `
            <td>
                <select name="items[${index}][barang_id]" class="barang-select" required>${options}</select>
            </td>
            <td>
                <input type="number" name="items[${index}][jumlah]" class="jumlah-input" min="1" value="${item.jumlah || 1}" required>
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
