<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="/css/custom.css">
</head>
<body>
    <nav>
        <div class="brand">Sistem Inventaris Barang</div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
