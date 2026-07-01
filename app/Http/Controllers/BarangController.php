<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $barangs = Barang::when($query, function ($q) use ($query) {
            return $q->where('kode_barang', 'like', "%{$query}%")
                ->orWhere('nama_barang', 'like', "%{$query}%");
        })->latest()->get();

        return view('Barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('Barang.create', [
            'barang' => new Barang(),
            'kategoriOptions' => [
                ['id' => 1, 'nama' => 'Elektronik'],
                ['id' => 2, 'nama' => 'Furniture'],
                ['id' => 3, 'nama' => 'ATK'],
            ],
            'satuanOptions' => [
                ['id' => 1, 'nama' => 'Pcs'],
                ['id' => 2, 'nama' => 'Box'],
                ['id' => 3, 'nama' => 'Kg'],
            ],
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
            'kategoriOptions' => [
                ['id' => 1, 'nama' => 'Elektronik'],
                ['id' => 2, 'nama' => 'Furniture'],
                ['id' => 3, 'nama' => 'ATK'],
            ],
            'satuanOptions' => [
                ['id' => 1, 'nama' => 'Pcs'],
                ['id' => 2, 'nama' => 'Box'],
                ['id' => 3, 'nama' => 'Kg'],
            ],
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
        //
    }

    public function destroy(string $id)
    {
        //
    }
}