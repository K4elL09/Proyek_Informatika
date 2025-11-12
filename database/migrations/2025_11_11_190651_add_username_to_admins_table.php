<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            // Tambahkan kolom 'username' setelah 'name'
            // Kita buat 'unique' dan 'nullable' (bisa dikosongi)
            $table->string('username')->unique()->nullable()->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};