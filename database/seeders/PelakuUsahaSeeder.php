<?php

namespace Database\Seeders;

use App\Models\PelakuUsaha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelakuUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PelakuUsaha::create([
            'NIB' => '1234567890',
            'nama' => 'Indo Tekstil Utama',
            'jenis_badan_usaha' => 'PT',
            'skala_usaha' => 'Kecil',
            'risiko' => 'Rendah',
            'tanggal_permohonan' => now(),
            'jenis_proyek' => 'Utama',
            'email' => 'usaha1@example.com',
            'no_telp' => '081234567890',
            'id_kbli' => 13921,
        ]);

        PelakuUsaha::create([
            'NIB' => '0987654321',
            'nama' => 'Pet Food',
            'jenis_badan_usaha' => 'PT',
            'skala_usaha' => 'Menengah',
            'risiko' => 'Menengah Rendah',
            'tanggal_permohonan' => now(),
            'jenis_proyek' => 'Pendukung',
            'email' => 'usaha2@example.com',
            'no_telp' => '081234567891',
            'id_kbli' => 10802,
        ]);

        PelakuUsaha::create([
            'NIB' => '1122334455',
            'nama' => 'Ahmad Riyanto',
            'jenis_badan_usaha' => 'Perseorangan',
            'skala_usaha' => 'Kecil',
            'risiko' => 'Rendah',
            'tanggal_permohonan' => now(),
            'jenis_proyek' => 'Utama',
            'email' => 'usaha3@example.com',
            'no_telp' => '081234567892',
            'id_kbli' => 16299,
        ]);
    }
}
