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
        Schema::create('pelaku_usaha', function (Blueprint $table) {
            $table->id('id_usaha');
            $table->unsignedBigInteger('NIB')->unique();
            $table->string('nama');
            $table->enum('jenis_badan_usaha', ['Perseorangan', 'PT', 'CV']);
            $table->enum('skala_usaha', ['Mikro', 'Kecil', 'Menengah', 'Besar']);
            $table->enum('risiko', ['Rendah', 'Menengah Rendah', 'Menengah Tinggi', 'Tinggi']);
            $table->enum('jenis_proyek', ['Utama', 'Pendukung']);
            $table->date('tanggal_permohonan');
            $table->string('email');
            $table->string('no_telp');
            $table->string('id_kbli', 5);
            $table->foreign('id_kbli')->references('id_kbli')->on('kbli')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaku_usaha');
    }
};
