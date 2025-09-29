<?php

namespace Database\Seeders;

use App\Models\Investasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Investasi::create([
            'modal_usaha' => 10000000,
            'investasi_mesin' => 5000000,
            'investasi_lainnya' => 2000000,
            'id_usaha' => 1,
        ]);

        Investasi::create([
            'modal_usaha' => 20000000,
            'investasi_mesin' => 8000000,
            'investasi_lainnya' => 3000000,
            'id_usaha' => 2,
        ]);

        Investasi::create([
            'modal_usaha' => 30000000,
            'investasi_mesin' => 15000000,
            'investasi_lainnya' => 5000000,
            'id_usaha' => 3,
        ]);
    }
}
