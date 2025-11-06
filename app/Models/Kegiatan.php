<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';

    protected $fillable = [
        'id_laporan',
        'urutan',
        'level',
        'id_pegawai_pelapor',
        'id_pegawai_monev',
        'kegiatan',
        'indikator_kegiatan',
        'satuan_kegiatan',
        'target_kegiatan',
        'realisasi_kinerja_kegiatan',
        'persen_kinerja_kegiatan',
        'pagu_kegiatan',
        'realisasi_keuangan_kegiatan',
        'persen_keuangan_kegiatan',
        'keterangan_kegiatan',
        'faktor_pendorong_kegiatan',
        'faktor_penghambat_kegiatan',
        'rekomendasi_kegiatan',
    ];

    protected $casts = [
        'target_kegiatan' => 'decimal:2',
        'realisasi_kinerja_kegiatan' => 'decimal:2',
        'persen_kinerja_kegiatan' => 'decimal:2',
        'pagu_kegiatan' => 'decimal:2',
        'realisasi_keuangan_kegiatan' => 'decimal:2',
        'persen_keuangan_kegiatan' => 'decimal:2',
    ];

    // Relationships
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

    public function pegawaiPelapor()
    {
        return $this->belongsTo(DataPegawai::class, 'id_pegawai_pelapor');
    }

    public function pegawaiMonev()
    {
        return $this->belongsTo(DataPegawai::class, 'id_pegawai_monev');
    }
}

