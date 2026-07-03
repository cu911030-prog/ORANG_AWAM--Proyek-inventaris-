<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            'Elektronik',
            'Alat Tulis Kantor',
            'Pakaian',
            'Makanan & Minuman',
            'Perabotan'
        ];

        foreach ($kategoris as $kat) {
            Kategori::create([
                'nama_kategori' => $kat,
                'slug' => Str::slug($kat),
            ]);
        }
    }
}