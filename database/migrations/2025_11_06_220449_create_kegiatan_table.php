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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->bigIncrements('id_kegiatan');
            $table->unsignedBigInteger('id_laporan');
            $table->integer('urutan');
            $table->enum('level', ['Kegiatan']);
            $table->unsignedBigInteger('id_pegawai_pelapor');
            $table->unsignedBigInteger('id_pegawai_monev');
            $table->text('kegiatan');
            $table->text('indikator_kegiatan');
            $table->enum('satuan_kegiatan', ['Persen', 'Dokumen']);
            $table->decimal('target_kegiatan', 10, 2);
            $table->decimal('realisasi_kinerja_kegiatan', 10, 2);
            $table->decimal('persen_kinerja_kegiatan', 10, 2);
            $table->decimal('pagu_kegiatan', 15, 2);
            $table->decimal('realisasi_keuangan_kegiatan', 15, 2);
            $table->decimal('persen_keuangan_kegiatan', 10, 2);
            $table->string('keterangan_kegiatan', 255);
            $table->text('faktor_pendorong_kegiatan');
            $table->text('faktor_penghambat_kegiatan');
            $table->text('rekomendasi_kegiatan');
            $table->timestamps();

            $table->foreign('id_laporan')->references('id_laporan')->on('laporan');
            $table->foreign('id_pegawai_pelapor')->references('id_pegawai')->on('data_pegawai');
            $table->foreign('id_pegawai_monev')->references('id_pegawai')->on('data_pegawai');
            
            $table->index('id_laporan');
            $table->index('id_pegawai_pelapor');
            $table->index('id_pegawai_monev');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
