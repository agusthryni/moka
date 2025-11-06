<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'program';
    protected $primaryKey = 'id_program';

    protected $fillable = [
        'id_laporan',
        'urutan',
        'level',
        'id_pegawai_pelapor',
        'id_pimpinan_monev',
        'program',
        'indikator_program',
        'satuan_program',
        'target_program',
        'realisasi_kinerja_program',
        'persen_kinerja_program',
        'pagu_program',
        'realisasi_keuangan_program',
        'persen_keuangan_program',
        'keterangan_program',
        'faktor_pendorong_program',
        'faktor_penghambat_program',
        'rekomendasi_program',
    ];

    protected $casts = [
        'target_program' => 'decimal:2',
        'realisasi_kinerja_program' => 'decimal:2',
        'persen_kinerja_program' => 'decimal:2',
        'pagu_program' => 'decimal:2',
        'realisasi_keuangan_program' => 'decimal:2',
        'persen_keuangan_program' => 'decimal:2',
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

