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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('nama_produk'); // <-- Contoh
        $table->decimal('harga', 10, 2);  // <-- Contoh
        $table->string('durasi_sewa');   // <-- Contoh
        $table->string('gambar_produk')->nullable(); // <-- Contoh
        $table->text('deskripsi')->nullable();      // <-- Contoh
        $table->timestamps(); // (membuat created_at dan updated_at)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
