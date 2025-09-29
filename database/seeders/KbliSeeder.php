<?php

namespace Database\Seeders;

use App\Models\Kbli;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KbliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kbli::create(['id_kbli' => 13921, 'jenis_kbli' => 'Industri Barang Jadi Tekstil Untuk Keperluan Rumah Tangga']);
        Kbli::create(['id_kbli' => 10802, 'jenis_kbli' => 'Industri Konsentrat Makanan Hewan']);
        Kbli::create(['id_kbli' => 16299, 'jenis_kbli' => 'Industri Barang Dari Kayu, Rotan, Gabus Lainnya YTDL']);
    }
}
