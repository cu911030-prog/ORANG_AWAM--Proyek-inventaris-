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
        $kategoris = Kategori::all(); 
        $satuans = Satuan::all();
    
        return view('Barang.create', compact('kategoris', 'satuans'));
    }

    public function store(Request $request)
    {
        // Validasi input data dari form (Sudah termasuk mengunci kategori dan satuan)
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required',
            'stok'        => 'required|numeric',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id', 
            'satuan_id'   => 'required|exists:satuans,id',   
        ]);

        // Simpan data asli pilihan user ke database MySQL
        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'kategori_id' => $request->kategori_id, // Mengambil data pilihan dari dropdown
            'satuan_id'   => $request->satuan_id,   // Mengambil data pilihan dari dropdown
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        $satuans = Satuan::all();

        return view('Barang.edit', compact('barang', 'kategoris', 'satuans'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,'.$id,
            'nama_barang' => 'required',
            'stok'        => 'required|numeric',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id', 
            'satuan_id'   => 'required|exists:satuans,id',   
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'kategori_id' => $request->kategori_id,
            'satuan_id'   => $request->satuan_id,
        ]);

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