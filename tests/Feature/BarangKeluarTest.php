<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarangKeluarTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_barang_keluar_page_shows_form(): void
    {
        $kategori = Kategori::create(['nama' => 'Alat Tulis']);
        $satuan = Satuan::create(['nama' => 'Pcs']);
        Barang::create([
            'kode_barang' => 'BRG-001',
            'nama_barang' => 'Pensil',
            'kategori_id' => $kategori->id,
            'satuan_id' => $satuan->id,
            'stok' => 10,
            'harga' => 5000,
        ]);

        $response = $this->get(route('barang-keluars.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Barang Keluar');
        $response->assertSee('Detail Barang');
        $response->assertSee('Pilih Barang');
    }

    public function test_store_barang_keluar_reduces_stock_and_saves_detail(): void
    {
        $kategori = Kategori::create(['nama' => 'Alat Tulis']);
        $satuan = Satuan::create(['nama' => 'Pcs']);
        $barang = Barang::create([
            'kode_barang' => 'BRG-001',
            'nama_barang' => 'Pensil',
            'kategori_id' => $kategori->id,
            'satuan_id' => $satuan->id,
            'stok' => 10,
            'harga' => 5000,
        ]);

        $payload = [
            'nomor_transaksi' => 'TRX-TEST-001',
            'tanggal_keluar' => now()->format('Y-m-d'),
            'keterangan' => 'Uji barang keluar',
            'items' => [
                [
                    'barang_id' => $barang->id,
                    'jumlah' => 3,
                ],
            ],
        ];

        $response = $this->post(route('barang-keluars.store'), $payload);

        $response->assertRedirect(route('barang-keluars.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('barang_keluars', [
            'nomor_transaksi' => 'TRX-TEST-001',
            'keterangan' => 'Uji barang keluar',
        ]);

        $this->assertDatabaseHas('barang_keluar_details', [
            'barang_id' => $barang->id,
            'jumlah' => 3,
        ]);

        $this->assertDatabaseHas('barangs', [
            'id' => $barang->id,
            'stok' => 7,
        ]);
    }
}
