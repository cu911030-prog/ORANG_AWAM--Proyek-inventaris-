<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $fillable = [
        'nomor_transaksi',
        'tanggal_keluar',
        'keterangan'
    ];

    // Relasi ke detail
    {
        return $this->hasMany(BarangKeluarDetail::class);
    }
}
