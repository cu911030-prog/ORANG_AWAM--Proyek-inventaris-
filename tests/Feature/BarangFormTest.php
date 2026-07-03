<?php

namespace Tests\Feature;

use Tests\TestCase;

class BarangFormTest extends TestCase
{
    public function test_create_barang_page_displays_hardcoded_category_and_unit_options(): void
    {
        $response = $this->get(route('barang.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Barang Baru');
        $response->assertSee('Elektronik');
        $response->assertSee('Furniture');
        $response->assertSee('Pcs');
        $response->assertSee('Box');
    }
}
