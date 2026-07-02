<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluarDetail extends Model
{
    protected $fillable = [
        'barang_keluar_id',
        'barang_id',
        'jumlah'
    ];
    
    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi ke transaksi barang keluar
    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class);
    }
}
