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
        Schema::create('sub_kegiatan', function (Blueprint $table) {
            $table->bigIncrements('id_sub_kegiatan');
            $table->unsignedBigInteger('id_laporan');
            $table->integer('urutan');
            $table->enum('level', ['Sub Kegiatan']);
            $table->unsignedBigInteger('id_pegawai_pelapor');
            $table->unsignedBigInteger('id_pimpinan_monev');
            $table->text('sub_kegiatan');
            $table->text('indikator_sub_kegiatan');
            $table->enum('satuan_sub_kegiatan', ['persen', 'dokumen']);
            $table->decimal('target_sub_kegiatan', 10, 2);
            $table->decimal('realisasi_kinerja_sub_kegiatan', 15, 2);
            $table->decimal('persen_kinerja_sub_kegiatan', 10, 2);
            $table->decimal('pagu_sub_kegiatan', 15, 2);
            $table->decimal('realisasi_keuangan_sub_kegiatan', 15, 2);
            $table->decimal('persen_keuangan_sub_kegiatan', 10, 2);
            $table->string('keterangan_sub_kegiatan', 255);
            $table->text('faktor_pendukung_sub_kegiatan');
            $table->text('faktor_penghambat_sub_kegiatan');
            $table->text('rekomendasi_sub_kegiatan');
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
        Schema::dropIfExists('sub_kegiatan');
    }
};
