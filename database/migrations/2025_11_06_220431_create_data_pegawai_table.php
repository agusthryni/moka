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
        Schema::create('data_pegawai', function (Blueprint $table) {
            $table->bigIncrements('id_pegawai');
            $table->string('nama_pegawai', 255);
            $table->string('nip', 20)->unique();
            $table->string('jabatan', 255);
            $table->enum('bidang', ['Sekretariat', 'TSDI', 'IKM', 'Koperasi', 'UPT']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pegawai');
    }
};
