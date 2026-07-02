<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama']; // Tambahkan ini agar tidak error saat mass assignment
}