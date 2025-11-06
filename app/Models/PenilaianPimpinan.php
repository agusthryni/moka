<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPimpinan extends Model
{
    use HasFactory;

    protected $table = 'penilaian_pimpinan';
    protected $primaryKey = 'id_penilaian_pimpinan';

    protected $fillable = [
        'id_laporan',
        'pimpinan',
        'penilaian',
    ];

    // Relationships
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }
}

