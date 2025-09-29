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
        Schema::create('pertumbuhan', function (Blueprint $table) {
            $table->id('id_pertumbuhan');
            $table->year('periode');      
            $table->enum('jenis_data', ['Verifikasi', 'Pengawasan', 'Energi', 'Bahan Baku', 'Tenaga Kerja', 'Investasi', 'Produksi', 'Skala Usaha']);   
            $table->integer('total'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertumbuhan');
    }
};
