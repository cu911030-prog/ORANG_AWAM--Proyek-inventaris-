<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Inventaris Barang') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-100">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-10 sm:pt-0">
            <div class="w-full sm:max-w-md px-6 mb-6 text-center">
                <a href="/" class="inline-flex items-center justify-center gap-3">
                    <x-application-logo class="w-16 h-16 text-slate-700" />
                    <div class="text-left">
                        <h1 class="text-2xl font-semibold text-slate-900">Sistem Inventaris Barang</h1>
                        <p class="text-sm text-slate-500">Kelola inventaris dengan cepat dan aman.</p>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-lg ring-1 ring-slate-200 sm:rounded-3xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
