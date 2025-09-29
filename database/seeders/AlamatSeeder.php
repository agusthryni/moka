<?php

namespace Database\Seeders;

use App\Models\Alamat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alamat::create([
            'alamat_usaha' => 'Jl. Soekarno Hatta KM 6 Bangun Reksa',
            'kelurahan' => 'Batu Ampar',
            'kecamatan' => 'Balikpapan Utara',
            'id_usaha' => 1,
        ]);

        Alamat::create([
            'alamat_usaha' => 'Jl. Ruhui Rahayu No.35',
            'kelurahan' => 'Sepinggan',
            'kecamatan' => 'Balikpapan Selatan',
            'id_usaha' => 2,
        ]);

        Alamat::create([
            'alamat_usaha' => 'Jl. Letjen Suprapto no.101',
            'kelurahan' => 'Baru Ulu',
            'kecamatan' => 'Balikpapan Barat',
            'id_usaha' => 3,
        ]);
    }
}
