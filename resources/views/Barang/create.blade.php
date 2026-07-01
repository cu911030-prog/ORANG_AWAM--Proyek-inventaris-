<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang Baru</title>
</head>
<body>
    <h1>Tambah Barang Baru</h1>

    <a href="{{ route('barang.index') }}">Kembali</a>

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
        @include('Barang._form')
        <button type="submit">Simpan</button>
    </form>
</body>
</html>