<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Http\Request;
use App\Models\Barang; 
use App\Models\Kategori; // Ditambahkan agar pemanggilan model lebih rapi
use App\Models\Satuan;   // Ditambahkan agar pemanggilan model lebih rapi

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
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        
        // PERBAIKAN: Mengambil data kategori dan satuan untuk form edit
        $kategoris = Kategori::all();
        $satuans = Satuan::all();

        // PERBAIKAN: Mengirimkan data ke view edit
        return view('Barang.edit', compact('barang', 'kategoris', 'satuans'));
    }

    public function update(BarangRequest $request, string $id)
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
// 1. Fungsi untuk menampilkan halaman form tambah barang
  

    // 2. Fungsi untuk menyimpan data baru ke database
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required',
            'stok'        => 'required|numeric',
            'harga'       => 'required|numeric',
        ]);

        // Simpan ke database MySQL
        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            // Nilai sementara agar relasi database (foreign key) tidak error
            'kategori_id' => 1, 
            'satuan_id'   => 1,
        ]);

        // Setelah sukses, kembali ke halaman daftar barang
        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan!');
    }
    }