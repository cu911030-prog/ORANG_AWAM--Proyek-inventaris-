<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $barangs = Barang::with(['kategori', 'satuan'])
            ->when($query, function ($q) use ($query) {
                return $q->where('kode_barang', 'like', "%{$query}%")
                    ->orWhere('nama_barang', 'like', "%{$query}%");
            })
            ->latest()
            ->get();

        return view('Barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('Barang.create', [
            'barang' => new Barang(),
            'kategoriOptions' => Kategori::orderBy('nama')->get(),
            'satuanOptions' => Satuan::orderBy('nama')->get(),
        ]);
    }

    public function store(BarangRequest $request)
    {
        Barang::create($request->validated());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambah!');
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);

        return view('Barang.edit', [
            'barang' => $barang,
            'kategoriOptions' => Kategori::orderBy('nama')->get(),
            'satuanOptions' => Satuan::orderBy('nama')->get(),
        ]);
    }

    public function update(BarangRequest $request, string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update($request->validated());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate!');
    }

    public function show(string $id)
    {
        $barang = Barang::with(['kategori', 'satuan'])->findOrFail($id);

        return view('Barang.show', compact('barang'));
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}