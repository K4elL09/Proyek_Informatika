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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            
            // Foreign Keys
            // Menghubungkan ulasan ke user yang memberikan ulasan
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Menghubungkan ulasan ke produk yang diulas
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); 
            
            // Kolom Ulasan
            $table->integer('rating')->default(0)->comment('Rating dari 1 hingga 5');
            $table->text('content')->nullable();
            
            $table->timestamps();

            // Memastikan satu user hanya bisa memberikan satu ulasan per produk
            $table->unique(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};