<div class="h-full p-6 bg-slate-950 text-slate-100">
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-3 text-white">
            <x-application-logo class="w-10 h-10 text-white" />
            <div>
                <div class="text-xl font-semibold">Inventaris</div>
                <div class="text-xs text-slate-400">Dashboard</div>
            </div>
        </a>
    </div>

    <nav class="space-y-1">
        <a href="{{ route('dashboard') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium bg-slate-800 text-white shadow-sm hover:bg-slate-700">
            Dashboard
        </a>
        <a href="#" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
            Barang
        </a>
        <a href="#" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
            Kategori Barang
        </a>
        <a href="#" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
            Satuan Barang
        </a>
        <a href="#" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
            Supplier
        </a>
        <a href="#" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
            Barang Masuk
        </a>
        <a href="#" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
            Barang Keluar
        </a>
    </nav>

    <div class="mt-12 pt-6 border-t border-slate-800 text-slate-500 text-xs">
        Placeholder menu. Lengkapi setelah modul lain terintegrasi.
    </div>
