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
        Schema::create('kapasitas_produksi', function (Blueprint $table) {
            $table->id('id_kapasitas_produksi');
            $table->unsignedBigInteger('id_usaha');
            $table->string('nama_produk');
            $table->integer('kapasitas');
            $table->string('satuan');
            $table->string('id_kbli', 5);
            $table->foreign('id_usaha')->references('id_usaha')->on('pelaku_usaha')->onDelete('cascade');
            $table->foreign('id_kbli')->references('id_kbli')->on('kbli')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kapasitas_produksi');
    }
};
