<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArahanPimpinan extends Model
{
    use HasFactory;

    protected $table = 'arahan_pimpinan';
    protected $primaryKey = 'id_arahan_pimpinan';

    protected $fillable = [
        'id_laporan',
        'pimpinan',
        'arahan',
    ];

    // Relationships
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }
}

