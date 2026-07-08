<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus atau komentari baris truncate karena migrate:fresh sudah otomatis mengosongkan tabel
        // Kategori::truncate();

        // Data seeder kategori
        $categories = [
            ['nama_kategori' => 'Elektronik', 'slug' => 'elektronik'],
            ['nama_kategori' => 'Pakaian', 'slug' => 'pakaian'],
            ['nama_kategori' => 'Atk', 'slug' => 'atk'],
            ['nama_kategori' => 'Makanan', 'slug' => 'makanan'],
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }
    }
}