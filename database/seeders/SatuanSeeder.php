<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satuans = [
            ['nama_satuan' => 'Pieces', 'simbol' => 'Pcs'],
            ['nama_satuan' => 'Kilogram', 'simbol' => 'Kg'],
            ['nama_satuan' => 'Box', 'simbol' => 'Box'],
            ['nama_satuan' => 'Liter', 'simbol' => 'L'],
            ['nama_satuan' => 'Pack', 'simbol' => 'Pack'],
        ];

        foreach ($satuans as $sat) {
            Satuan::create($sat);
        }
    }
}