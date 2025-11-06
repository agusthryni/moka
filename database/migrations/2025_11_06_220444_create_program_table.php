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
        Schema::create('program', function (Blueprint $table) {
            $table->bigIncrements('id_program');
            $table->unsignedBigInteger('id_laporan');
            $table->integer('urutan');
            $table->enum('level', ['Program']);
            $table->unsignedBigInteger('id_pegawai_pelapor');
            $table->unsignedBigInteger('id_pimpinan_monev');
            $table->text('program');
            $table->text('indikator_program');
            $table->enum('satuan_program', ['Persen', 'Dokumen']);
            $table->decimal('target_program', 10, 2);
            $table->decimal('realisasi_kinerja_program', 15, 2);
            $table->decimal('persen_kinerja_program', 10, 2);
            $table->decimal('pagu_program', 15, 2);
            $table->decimal('realisasi_keuangan_program', 15, 2);
            $table->decimal('persen_keuangan_program', 10, 2);
            $table->string('keterangan_program', 255);
            $table->text('faktor_pendorong_program');
            $table->text('faktor_penghambat_program');
            $table->text('rekomendasi_program');
            $table->timestamps();

            $table->foreign('id_laporan')->references('id_laporan')->on('laporan');
            $table->foreign('id_pegawai_pelapor')->references('id_pegawai')->on('data_pegawai');
            $table->foreign('id_pimpinan_monev')->references('id_pegawai')->on('data_pegawai');
            
            $table->index('id_laporan');
            $table->index('id_pegawai_pelapor');
            $table->index('id_pimpinan_monev');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
