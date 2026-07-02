<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satuan;

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        $satuans = [
            ['nama' => 'pcs'],
            ['nama' => 'kg'],
            ['nama' => 'liter'],
            ['nama' => 'box'],
            ['nama' => 'lusin'],
        ];

        foreach ($satuans as $satuan) {
            Satuan::updateOrCreate(['nama' => $satuan['nama']], $satuan);
        }
    }
}