<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Tambahkan ini agar bisa simpan data dari form
    protected $fillable = [
        'kode_barang', 
        'nama_barang', 
        'kategori_id', 
        'satuan_id', 
        'stok', 
        'harga'
    ];
}
