<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    use HasFactory;

    protected $table = 'data_pegawai';
    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama_pegawai',
        'nip',
        'jabatan',
        'bidang',
    ];

    // Relationships
    public function programsAsPelapor()
    {
        return $this->hasMany(Program::class, 'id_pegawai_pelapor');
    }

    public function programsAsMonev()
    {
        return $this->hasMany(Program::class, 'id_pimpinan_monev');
    }

    public function kegiatansAsPelapor()
    {
        return $this->hasMany(Kegiatan::class, 'id_pegawai_pelapor');
    }

    public function kegiatansAsMonev()
    {
        return $this->hasMany(Kegiatan::class, 'id_pegawai_monev');
    }

    public function subKegiatansAsPelapor()
    {
        return $this->hasMany(SubKegiatan::class, 'id_pegawai_pelapor');
    }

    public function subKegiatansAsMonev()
    {
        return $this->hasMany(SubKegiatan::class, 'id_pimpinan_monev');
    }

    public function melaporkans()
    {
        return $this->hasMany(Melaporkan::class, 'id_pegawai');
    }
}

