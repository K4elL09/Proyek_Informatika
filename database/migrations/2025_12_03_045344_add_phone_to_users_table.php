<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: Tambahkan kolom 'phone'.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ditempatkan setelah kolom 'photo', memastikan urutan yang benar
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 15)->nullable()->after('photo'); 
            }
        });
    }

    /**
     * Batalkan migrasi: Hapus kolom 'phone'.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
};