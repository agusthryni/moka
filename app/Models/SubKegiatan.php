<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    use HasFactory;

    protected $table = 'sub_kegiatan';
    protected $primaryKey = 'id_sub_kegiatan';

    protected $fillable = [
        'id_laporan',
        'urutan',
        'level',
        'id_pegawai_pelapor',
        'id_pimpinan_monev',
        'sub_kegiatan',
        'indikator_sub_kegiatan',
        'satuan_sub_kegiatan',
        'target_sub_kegiatan',
        'realisasi_kinerja_sub_kegiatan',
        'persen_kinerja_sub_kegiatan',
        'pagu_sub_kegiatan',
        'realisasi_keuangan_sub_kegiatan',
        'persen_keuangan_sub_kegiatan',
        'keterangan_sub_kegiatan',
        'faktor_pendukung_sub_kegiatan',
        'faktor_penghambat_sub_kegiatan',
        'rekomendasi_sub_kegiatan',
    ];

    protected $casts = [
        'target_sub_kegiatan' => 'decimal:2',
        'realisasi_kinerja_sub_kegiatan' => 'decimal:2',
        'persen_kinerja_sub_kegiatan' => 'decimal:2',
        'pagu_sub_kegiatan' => 'decimal:2',
        'realisasi_keuangan_sub_kegiatan' => 'decimal:2',
        'persen_keuangan_sub_kegiatan' => 'decimal:2',
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

    public function pimpinanMonev()
    {
        return $this->belongsTo(DataPegawai::class, 'id_pimpinan_monev');
    }
}

