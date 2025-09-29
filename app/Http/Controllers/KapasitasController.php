<?php

namespace App\Http\Controllers;

use App\Models\PelakuUsaha;
use Illuminate\Http\Request;

class KapasitasController extends Controller
{
    public function index() 
    {
        $data = PelakuUsaha::with('kapasitasProduksi', 'kbli', 'alamat')->get();

        return view('data-kapasitas', compact('data'));
    }
}
