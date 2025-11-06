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
        Schema::create('laporan', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');
            $table->enum('bidang', ['Sekretariat', 'TSDI', 'IKM', 'Koperasi', 'UPT']);
            $table->year('tahun');
            $table->enum('triwulan', ['Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
