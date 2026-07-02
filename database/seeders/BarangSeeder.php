<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriIds = Kategori::pluck('id')->toArray();
        $satuanIds = Satuan::pluck('id')->toArray();

        if (empty($kategoriIds)) {
            $kategoriIds = [1];
        }

        if (empty($satuanIds)) {
            $satuanIds = [1];
        }

        for ($i = 1; $i <= 10; $i++) {
            Barang::updateOrCreate([
                'kode_barang' => 'BRG' . str_pad($i, 3, '0', STR_PAD_LEFT),
            ], [
                'nama_barang' => 'Barang Dummy ' . $i,
                'kategori_id' => $kategoriIds[($i - 1) % count($kategoriIds)],
                'satuan_id'   => $satuanIds[($i - 1) % count($satuanIds)],
                'stok'        => 10 + $i,
                'harga'       => 10000 + ($i * 500),
            ]);
        }
    }
}
