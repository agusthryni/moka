<?php

namespace Database\Seeders;

use App\Models\KapasitasProduksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KapasitasProduksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KapasitasProduksi::create([
            'nama_produk' => 'Kain Lap',
            'kapasitas' => 1000,
            'satuan' => 'kg',
            'id_usaha' => 1,
            'id_kbli' => 13921,
        ]);

        KapasitasProduksi::create([
            'nama_produk' => 'Dedak',
            'kapasitas' => 2000,
            'satuan' => 'liter',
            'id_usaha' => 2,
            'id_kbli' => 10802,
        ]);

        KapasitasProduksi::create([
            'nama_produk' => 'Kursi Jati',
            'kapasitas' => 100,
            'satuan' => 'buah',
            'id_usaha' => 3,
            'id_kbli' => 16299,
        ]);
    }
}
