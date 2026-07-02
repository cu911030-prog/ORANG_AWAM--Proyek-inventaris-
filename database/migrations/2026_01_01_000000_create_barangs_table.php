<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('barangs', function (Blueprint $table) {
        $table->id();
        $table->string('kode_barang', 30)->unique();
        $table->string('nama_barang', 150);
        
        // Menggunakan foreignId untuk membuat constraint relasi
        $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        $table->foreignId('satuan_id')->constrained('satuans')->onDelete('cascade');
        
        $table->integer('stok')->default(0);
        $table->decimal('harga', 15, 2)->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
