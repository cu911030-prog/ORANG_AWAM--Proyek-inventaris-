<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\BarangKeluarDetail;

class BarangKeluar extends Model
{
    protected $fillable = [
        'nomor_transaksi',
        'tanggal_keluar',
        'keterangan'
    ];

    // Relasi ke detail barang keluar
    public function details()
    {
        return $this->hasMany(BarangKeluarDetail::class);
    }

    // Relasi many-to-many ke barang lewat pivot detail
    public function barangs()
    {
        return $this->belongsToMany(Barang::class, 'barang_keluar_details')
            ->withPivot('jumlah')
            ->withTimestamps();
    }
}
