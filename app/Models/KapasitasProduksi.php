<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapasitasProduksi extends Model
{
    use HasFactory;
    protected $table = 'kapasitas_produksi';
    protected $primaryKey = 'id_kapasitas_produksi';
    protected $fillable = ['id_usaha', 'nama_produk', 'kapasitas', 'satuan', 'id_kbli'];

    public function pelakuUsaha()
    {
        return $this->belongsTo('App\Models\PelakuUsaha', 'id_usaha');
    }

    public function kbli()
    {
        return $this->belongsTo('App\Models\Kbli', 'id_kbli');
    }
}
