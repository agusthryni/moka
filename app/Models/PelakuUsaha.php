<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelakuUsaha extends Model
{
    use HasFactory;

    protected $table = 'pelaku_usaha';

    protected $primaryKey = 'id_usaha';

    protected $fillable = [
        'NIB',
        'nama',
        'jenis_badan_usaha',
        'skala_usaha',
        'risiko',
        'tanggal_permohonan',
        'jenis_proyek',
        'email',
        'no_telp',
        'id_kbli',
    ];

    protected $dates = ['tanggal_permohonan'];

    // Accessor untuk tanggal_permohonan
    public function getTanggalPermohonanAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function alamat()
    {
        return $this->hasOne('App\Models\Alamat', 'id_usaha');
    }
    
public function kbli()
    {
        return $this->belongsTo('App\Models\Kbli', 'id_kbli');
    }

    public function investasi()
    {
        return $this->hasOne('App\Models\Investasi', 'id_usaha');
    }

    public function tenagaKerja()
    {
        return $this->hasOne('App\Models\TenagaKerja', 'id_usaha');
    }

    public function kapasitasProduksi()
    {
        return $this->hasMany('App\Models\KapasitasProduksi', 'id_usaha');
    }
}
