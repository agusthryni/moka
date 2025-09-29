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
        // Add PT Perseorangan ke enum
        DB::statement("ALTER TABLE pelaku_usaha MODIFY jenis_badan_usaha ENUM('Perseorangan','PT', 'CV', 'PT Perseorangan', 'Badan Hukum Lainnya', 'Badan Layanan Umum', 'Koperasi', 'Persekutuan dan Perkumpulan', 'Perusahaan Umum', 'Yayasan')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Hapus "PT Perseorangan" dari enum
        DB::statement("ALTER TABLE pelaku_usaha MODIFY jenis_badan_usaha ENUM('Perseorangan','PT', 'CV', 'PT Perseorangan')");
    }
};