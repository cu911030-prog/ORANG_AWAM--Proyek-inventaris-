<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    // Pastikan baris $fillable ini ada agar form simpan berfungsi maksimal!
    protected $fillable = [
        'nama_satuan',
        'simbol',
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}