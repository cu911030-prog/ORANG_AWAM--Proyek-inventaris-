<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang; // Memudahkan penulisan model

class BarangController extends Controller
{
    
    public function index(Request $request)
    {
        $query = $request->input('search');

        // Mengambil semua data barang
        $barangs = Barang::when($query, function ($q) use ($query) {
            return $q->where('kode_barang', 'like', "%{$query}%")
                     ->orWhere('nama_barang', 'like', "%{$query}%");
        })->get();
        
        return view('Barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('Barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'stok'        => 'required|numeric',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required',
            'satuan_id'   => 'required',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambah!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('Barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'stok'        => 'required|numeric',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required',
            'satuan_id'   => 'required',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

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