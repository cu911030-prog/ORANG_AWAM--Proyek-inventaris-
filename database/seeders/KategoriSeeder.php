<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Elektronik'],
            ['nama' => 'Furniture'],
            ['nama' => 'ATK'],
            ['nama' => 'Makanan'],
            ['nama' => 'Minuman'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::updateOrCreate(['nama' => $kategori['nama']], $kategori);
        }
    }
}
