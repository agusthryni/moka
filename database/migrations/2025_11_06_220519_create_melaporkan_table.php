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
        Schema::create('melaporkan', function (Blueprint $table) {
            $table->bigIncrements('id_melapor');
            $table->unsignedBigInteger('id_laporan');
            $table->unsignedBigInteger('id_pegawai');
            $table->string('jabatan', 255);
            $table->timestamps();

            $table->foreign('id_laporan')->references('id_laporan')->on('laporan');
            $table->foreign('id_pegawai')->references('id_pegawai')->on('data_pegawai');
            
            $table->index('id_laporan');
            $table->index('id_pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('melaporkan');
    }
};
