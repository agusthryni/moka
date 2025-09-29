<?php

namespace App\Http\Controllers;

use App\Models\PelakuUsaha;
use Illuminate\Http\Request;

class InvestasiController extends Controller
{
    public function index() 
    {
        $data = PelakuUsaha::with('tenagaKerja', 'kbli', 'alamat', 'investasi')->get();

        return view('data-investasi', compact('data'));
    }
}
