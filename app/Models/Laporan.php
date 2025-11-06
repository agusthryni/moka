<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    public $timestamps = false; // Disable timestamps since table doesn't have updated_at/created_at

    protected $fillable = [
        'bidang',
        'tahun',
        'triwulan',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    // Relationships
    public function programs()
    {
        return $this->hasMany(Program::class, 'id_laporan');
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'id_laporan');
    }

    public function subKegiatans()
    {
        return $this->hasMany(SubKegiatan::class, 'id_laporan');
    }

    public function penilaianPimpinans()
    {
        return $this->hasMany(PenilaianPimpinan::class, 'id_laporan');
    }

    public function arahanPimpinans()
    {
        return $this->hasMany(ArahanPimpinan::class, 'id_laporan');
    }

    public function melaporkans()
    {
        return $this->hasMany(Melaporkan::class, 'id_laporan');
    }
}

