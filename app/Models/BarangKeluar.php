<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_transaksi',
        'tanggal_keluar',
        'keterangan'
    ];
    // Relasi ke detail
    public function details()
    {
        return $this->hasMany(BarangKeluarDetail::class, 'barang_keluar_id');
    }

    // Relasi many-to-many ke barang lewat pivot detail
    public function barangs()
    {
        return $this->belongsToMany(Barang::class, 'barang_keluar_details')
            ->withPivot('jumlah')
            ->withTimestamps();
    }
}
