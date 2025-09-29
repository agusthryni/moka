<?php

namespace App\Http\Controllers;

use App\Models\Kbli;
use App\Models\PelakuUsaha;
use App\Models\TenagaKerja;
use Illuminate\Http\Request;

class TenagaKerjaController extends Controller
{
    public function index() 
    {
        $data = PelakuUsaha::with('tenagaKerja', 'kbli', 'alamat')->get();

        return view('data-tenaker', compact('data'));
    }
}
