<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $barangKeluars = BarangKeluar::with(['details.barang'])
            ->when($query, function ($q) use ($query) {
                return $q->where('nomor_transaksi', 'like', "%{$query}%")
                    ->orWhereHas('details.barang', function ($q2) use ($query) {
                        $q2->where('kode_barang', 'like', "%{$query}%")
                            ->orWhere('nama_barang', 'like', "%{$query}%");
                    });
            })
            ->latest()
            ->get();

        return view('barang-keluar.index', compact('barangKeluars'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_transaksi' => 'required|string|unique:barang_keluars,nomor_transaksi',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($data) {
            $barangKeluar = BarangKeluar::create([
                'nomor_transaksi' => $data['nomor_transaksi'],
                'tanggal_keluar' => $data['tanggal_keluar'],
                'keterangan' => $data['keterangan'] ?? null,
            ]);

            foreach ($data['items'] as $item) {
                $barang = Barang::lockForUpdate()->findOrFail($item['barang_id']);

                if ($barang->stok < $item['jumlah']) {
                    throw new \Exception('Stok ' . $barang->nama_barang . ' tidak mencukupi');
                }

                $barangKeluar->details()->create([
                    'barang_id' => $barang->id,
                    'jumlah' => $item['jumlah'],
                ]);

                $barang->decrement('stok', $item['jumlah']);
            }
        });

        return redirect()->route('barang-keluars.index')->with('success', 'Transaksi barang keluar berhasil disimpan.');
    }
}
