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
        Schema::create('arahan_pimpinan', function (Blueprint $table) {
            $table->bigIncrements('id_arahan_pimpinan');
            $table->unsignedBigInteger('id_laporan');
            $table->enum('pimpinan', ['Kepala Dinas', 'Sekretaris/Kepala Bidang']);
            $table->text('arahan');
            $table->timestamps();

            $table->foreign('id_laporan')->references('id_laporan')->on('laporan');
            $table->index('id_laporan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arahan_pimpinan');
    }
};
