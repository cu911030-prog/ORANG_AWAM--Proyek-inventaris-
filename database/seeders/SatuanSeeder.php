<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satuan;

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        Satuan::create(['nama' => 'Pcs']);
        Satuan::create(['nama' => 'Box']);
        Satuan::create(['nama' => 'Pack']);
    }
}