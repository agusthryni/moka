<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kbli extends Model
{
    use HasFactory;
    protected $table = 'kbli';
    protected $primaryKey = 'id_kbli';
    public $incrementing = false;
    protected $keyType = 'string'; 
    protected $fillable = ['id_kbli', 'jenis_kbli'];
    
    public function pelakuUsaha()
    {
        return $this->hasMany('App\Models\PelakuUsaha', 'id_kbli');
    }

    public function kapasitasProduksi()
    {
        return $this->hasMany('App\Models\KapasitasProduksi', 'id_kbli');
    }
}
