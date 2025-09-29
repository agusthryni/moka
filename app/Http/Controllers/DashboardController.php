<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as FacadesRequest;

use App\Models\PelakuUsaha;
use App\Models\TenagaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data pelaku usaha beserta kecamatannya
        $data = PelakuUsaha::join('alamat', 'pelaku_usaha.id_usaha', '=', 'alamat.id_usaha')
            ->select('alamat.kecamatan', 'pelaku_usaha.jenis_badan_usaha', DB::raw('count(*) as total'))
            ->groupBy('alamat.kecamatan', 'pelaku_usaha.jenis_badan_usaha')
            ->get();

        // Siapkan data untuk chart
        $kecamatan = ['Balikpapan Selatan', 'Balikpapan Kota', 'Balikpapan Timur', 'Balikpapan Utara', 'Balikpapan Tengah', 'Balikpapan Barat'];
        $jenisUsaha = ['perseorangan', 'PT', 'CV', 'PT Perseorangan', 'Badan Hukum Lainnya', 'Badan Layanan Umum', 'Koperasi', 'Persekutuan dan Perkumpulan', 'Perusahaan Umum', 'Yayasan'];

        $chartData = [];
        foreach ($kecamatan as $kec) {
            $tempData = ['kecamatan' => $kec];
            foreach ($jenisUsaha as $jenis) {
                $total = $data->where('kecamatan', $kec)->where('jenis_badan_usaha', $jenis)->first()->total ?? 0;
                $tempData[$jenis] = $total;
            }
            $chartData[] = $tempData;
        }

        // Ambil data jumlah tenaga kerja laki-laki dan perempuan
        $tenagaKerjaData = TenagaKerja::join('pelaku_usaha', 'tenaga_kerja.id_usaha', '=', 'pelaku_usaha.id_usaha')
            ->join('alamat', 'pelaku_usaha.id_usaha', '=', 'alamat.id_usaha')
            ->select('alamat.kecamatan', DB::raw('SUM(tenaga_kerja.jumlah_tki_laki_laki) as total_lk'), DB::raw('SUM(tenaga_kerja.jumlah_tki_perempuan) as total_pr'))
            ->groupBy('alamat.kecamatan')
            ->get();

        $tenagaKerjaChartData = [];
        foreach ($kecamatan as $kec) {
            $tempData = [
                'kecamatan' => $kec,
                'total_lk' => $tenagaKerjaData->where('kecamatan', $kec)->first()->total_lk ?? 0,
                'total_pr' => $tenagaKerjaData->where('kecamatan', $kec)->first()->total_pr ?? 0,
            ];
            $tenagaKerjaChartData[] = $tempData;
        }

        // Hitung jumlah pelaku usaha berdasarkan risiko
        $risiko = ['Rendah', 'Menengah Rendah', 'Menengah Tinggi', 'Tinggi'];
        $risikoData = [];
        foreach ($kecamatan as $kec) {
            $tempData = ['kecamatan' => $kec];
            foreach ($risiko as $r) {
                $total = PelakuUsaha::join('alamat', 'pelaku_usaha.id_usaha', '=', 'alamat.id_usaha')
                    ->where('alamat.kecamatan', $kec)
                    ->where('pelaku_usaha.risiko', $r)
                    ->count();
                $tempData[$r] = $total;
            }
            $risikoData[] = $tempData;
        }

        // Hitung jumlah pelaku usaha berdasarkan skala usaha
        $mikro = PelakuUsaha::where('skala_usaha', 'mikro')->count();
        $kecil = PelakuUsaha::where('skala_usaha', 'kecil')->count();
        $menengah = PelakuUsaha::where('skala_usaha', 'menengah')->count();
        $besar = PelakuUsaha::where('skala_usaha', 'besar')->count();

        // Hitung jumlah pelaku usaha berdasarkan risiko
        $rendah = PelakuUsaha::where('risiko', 'Rendah')->count();
        $menengahRendah = PelakuUsaha::where('risiko', 'Menengah Rendah')->count();
        $menengahTinggi = PelakuUsaha::where('risiko', 'Menengah Tinggi')->count();
        $tinggi = PelakuUsaha::where('risiko', 'Tinggi')->count();

        // Hitung jumlah pelaku usaha berdasarkan jenis badan usaha
        $perseorangan = PelakuUsaha::where('jenis_badan_usaha', 'perseorangan')->count();
        $pt = PelakuUsaha::where('jenis_badan_usaha', 'PT')->count();
        $cv = PelakuUsaha::where('jenis_badan_usaha', 'CV')->count();
        $ptPerseorangan = PelakuUsaha::where('jenis_badan_usaha', 'PT Perseorangan')->count();
        $bhl = PelakuUsaha::where('jenis_badan_usaha', 'Badan Hukum Lainnya')->count();
        $blu = PelakuUsaha::where('jenis_badan_usaha', 'Badan Layanan Umum')->count();
        $koperasi = PelakuUsaha::where('jenis_badan_usaha', 'Koperasi')->count();
        $pdp = PelakuUsaha::where('jenis_badan_usaha', 'Persekutuan dan Perkumpulan')->count();
        $perum = PelakuUsaha::where('jenis_badan_usaha', 'Perusahaan Umum')->count();
        $yayasan = PelakuUsaha::where('jenis_badan_usaha', 'Yayasan')->count();

        // Hitung Tenaga Kerja
        $tenagalk = TenagaKerja::sum('jumlah_tki_laki_laki');
        $tenagapr = TenagaKerja::sum('jumlah_tki_perempuan');
        $tenagaasing= TenagaKerja::sum('jumlah_tenaga_kerja_asing');

        // Total Investasi Berdasarkan Skala Usaha
        $totalInvestasi = PelakuUsaha::select('skala_usaha', DB::raw('SUM(investasi.modal_usaha + investasi.investasi_mesin + investasi.investasi_lainnya) as total_investment'))
        ->join('investasi', 'pelaku_usaha.id_usaha', '=', 'investasi.id_usaha')
        ->groupBy('skala_usaha')
        ->pluck('total_investment', 'skala_usaha');

        // Ambil data total investasi berdasarkan jenis badan usaha
        $totalInvestmentsByType = PelakuUsaha::join('investasi', 'pelaku_usaha.id_usaha', '=', 'investasi.id_usaha')
        ->select('jenis_badan_usaha', 
            DB::raw('SUM(modal_usaha + investasi_mesin + investasi_lainnya) as total_investasi'))
        ->groupBy('jenis_badan_usaha')
        ->pluck('total_investasi', 'jenis_badan_usaha');

        // Hitung pertumbuhan industri per triwulan
        $triwulanData = DB::table('pelaku_usaha')
        ->selectRaw("YEAR(tanggal_permohonan) as tahun, QUARTER(tanggal_permohonan) as triwulan, skala_usaha, COUNT(*) as total")
        ->groupBy(DB::raw("YEAR(tanggal_permohonan), QUARTER(tanggal_permohonan), skala_usaha"))
        ->orderBy('tahun')
        ->orderBy('triwulan')
        ->get();

        // Hitung total pertumbuhan per tahun
        $tahunanData = DB::table('pelaku_usaha')
        ->selectRaw("YEAR(tanggal_permohonan) as tahun, COUNT(*) as total")
        ->groupBy(DB::raw("YEAR(tanggal_permohonan)"))
        ->orderBy('tahun')
        ->get();

        return view('dashboard', compact(
            'kecamatan',
            'chartData',
            'jenisUsaha',
            'mikro',
            'kecil',
            'risiko',
            'risikoData',
            'menengah',
            'besar',
            'rendah',
            'menengahRendah',
            'menengahTinggi',
            'tinggi',
            'perseorangan',
            'pt',
            'cv',
            'ptPerseorangan',
            'bhl',
            'blu',
            'koperasi',
            'pdp',
            'perum',
            'yayasan',
            'tenagaKerjaChartData',
            'tenagalk',
            'tenagapr',
            'tenagaasing',
            'totalInvestasi',
            'totalInvestmentsByType',
            'triwulanData',
            'tahunanData'
        ));
    }
    public function mapindustri()
    {
        return view();
    }
}