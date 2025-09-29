<?php

namespace Database\Seeders;

use App\Models\TenagaKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenagaKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TenagaKerja::create([
            'jumlah_tki_laki_laki' => 10,
            'jumlah_tki_perempuan' => 5,
            'jumlah_tenaga_kerja_asing' => 0,
            'id_usaha' => 1,
        ]);

        TenagaKerja::create([
            'jumlah_tki_laki_laki' => 15,
            'jumlah_tki_perempuan' => 8,
            'jumlah_tenaga_kerja_asing' => 0,
            'id_usaha' => 2,
        ]);

        TenagaKerja::create([
            'jumlah_tki_laki_laki' => 20,
            'jumlah_tki_perempuan' => 10,
            'jumlah_tenaga_kerja_asing' => 1,
            'id_usaha' => 3,
        ]);
    }
}
