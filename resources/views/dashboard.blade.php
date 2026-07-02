<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid gap-6 px-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-3xl bg-slate-950 p-6 text-white shadow-xl">
            <div class="text-sm uppercase tracking-[0.3em] text-slate-400">Total Barang</div>
            <div class="mt-4 text-3xl font-bold">0</div>
        </div>
        <div class="rounded-3xl bg-slate-950 p-6 text-white shadow-xl">
            <div class="text-sm uppercase tracking-[0.3em] text-slate-400">Barang Masuk</div>
            <div class="mt-4 text-3xl font-bold">0</div>
        </div>
        <div class="rounded-3xl bg-slate-950 p-6 text-white shadow-xl">
            <div class="text-sm uppercase tracking-[0.3em] text-slate-400">Barang Keluar</div>
            <div class="mt-4 text-3xl font-bold">0</div>
        </div>
        <div class="rounded-3xl bg-slate-950 p-6 text-white shadow-xl">
            <div class="text-sm uppercase tracking-[0.3em] text-slate-400">Supplier</div>
            <div class="mt-4 text-3xl font-bold">0</div>
        </div>
    </div>

    <div class="mt-10 rounded-3xl bg-white p-6 shadow-xl">
        <h3 class="text-lg font-semibold text-slate-900">Aktivitas Terbaru</h3>
        <div class="mt-6 text-slate-600">Belum ada aktivitas terbaru.</div>
    </div>
</x-app-layout>
