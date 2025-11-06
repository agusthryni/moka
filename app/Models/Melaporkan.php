<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Melaporkan extends Model
{
    use HasFactory;

    protected $table = 'melaporkan';
    protected $primaryKey = 'id_melapor';

    protected $fillable = [
        'id_laporan',
        'id_pegawai',
        'jabatan',
    ];

    // Relationships
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

    public function pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'id_pegawai');
    }
}

