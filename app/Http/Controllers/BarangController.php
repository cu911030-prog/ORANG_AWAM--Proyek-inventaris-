<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang; 
use App\Models\Kategori; // Ditambahkan agar pemanggilan model lebih rapi
use App\Models\Satuan;   // Ditambahkan agar pemanggilan model lebih rapi

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
        $kategoris = Kategori::all(); 
        $satuans = Satuan::all();
    
        // PERBAIKAN: Menambahkan compact agar variabel terkirim ke view
        return view('Barang.create', compact('kategoris', 'satuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'stok'        => 'required|numeric',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id', // Validasi diperketat agar aman
            'satuan_id'   => 'required|exists:satuans,id',   // Validasi diperketat agar aman
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
        
        // PERBAIKAN: Mengambil data kategori dan satuan untuk form edit
        $kategoris = Kategori::all();
        $satuans = Satuan::all();

        // PERBAIKAN: Mengirimkan data ke view edit
        return view('Barang.edit', compact('barang', 'kategoris', 'satuans'));
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
            'kategori_id' => 'required|exists:kategoris,id', // Validasi diperketat agar aman
            'satuan_id'   => 'required|exists:satuans,id',   // Validasi diperketat agar aman
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