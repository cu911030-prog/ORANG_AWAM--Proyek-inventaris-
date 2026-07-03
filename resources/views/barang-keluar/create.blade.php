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

    @include('barang-keluar.form')
</body>
</html>
