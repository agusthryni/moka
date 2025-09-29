<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaKerja extends Model
{
    use HasFactory;
    protected $table = 'tenaga_kerja';
    protected $primaryKey = 'id_tenaga_kerja';
    protected $fillable = ['jumlah_tki_laki_laki', 'jumlah_tki_perempuan', 'jumlah_tenaga_kerja_asing', 'id_usaha'];

    public function pelakuUsaha()
    {
        return $this->belongsTo('App\Models\PelakuUsaha', 'id_usaha');
    }
}
