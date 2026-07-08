<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    // Pastikan kedua kolom ini ada di dalam fillable
    protected $fillable = ['nama_kategori', 'slug']; 
}