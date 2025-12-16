<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('transaksi', function (Blueprint $table) {
        // Menambahkan kolom no_hp setelah kolom nama
        $table->string('no_hp')->nullable()->after('nama');
    });
}

public function down()
{
    Schema::table('transaksi', function (Blueprint $table) {
        $table->dropColumn('no_hp');
    });
}
    };
    
