<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Barang::create([
                'kode_barang' => 'BRG' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_barang' => 'Barang Dummy ' . $i,
                'kategori_id' => 1, 
                'satuan_id'   => 1, 
                'stok'        => 10,
                'harga'       => 10000,
            ]);
        }
    }
}
