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

        Schema::table('pelaku_usaha', function (Blueprint $table) {
            $table->dropUnique('pelaku_usaha_nib_unique');
        });
    }

    /**
     * Unique rollback
     */
    public function down(): void
    {

        Schema::table('pelaku_usaha', function (Blueprint $table) {
            $table->unique('NIB');
        });
    }
};
