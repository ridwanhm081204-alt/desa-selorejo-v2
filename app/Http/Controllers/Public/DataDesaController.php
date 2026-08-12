<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DataPenduduk;
use App\Models\Setting;
use App\Models\StatistikPenduduk;
use Illuminate\Http\Request;

class DataDesaController extends Controller
{
    public function statistik()
    {
        $statistikRaw = StatistikPenduduk::all()->groupBy('jenis_data');
        $statistik = $statistikRaw->toArray();

        // If real data exists in data_penduduk table, override 'usia' and 'gender' dynamically
        $totalRealData = DataPenduduk::count();
        if ($totalRealData > 0) {
            $agregat = DataPenduduk::getStatistikAgregat();

            // Override age chart data
            $ageChart = [];
            foreach ($agregat['kelompok_usia'] as $item) {
                $ageChart[] = [
                    'label' => $item['label'],
                    'nilai' => $item['jumlah'],
                ];
            }
            $statistik['usia'] = $ageChart;

            // Override gender chart data
            $statistik['gender'] = [
                ['label' => 'Laki-Laki', 'nilai' => $agregat['gender']['L']],
                ['label' => 'Perempuan', 'nilai' => $agregat['gender']['P']],
            ];
        }

        $heroValue = Setting::where('key', 'hero_statistik')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : [
            'title' => 'Statistik Demografi Desa',
            'subtitle' => 'Transparansi data penduduk Desa Wisata Selorejo berdasarkan angka riil kependudukan.',
            'icon' => 'bar-chart-2'
        ];

        return view('public.data.statistik', compact('statistik', 'hero', 'totalRealData'));
    }

    public function apbdes()
    {
        $heroValue = Setting::where('key', 'hero_apbdes')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : [
            'title' => 'Transparansi APBDes',
            'subtitle' => 'Laporan Anggaran Pendapatan dan Belanja Desa Selorejo Tahun Anggaran 2024.',
            'icon' => 'file-text'
        ];
        return view('public.data.apbdes', [
            'apbdes' => \App\Models\Apbdes::orderBy('tahun', 'desc')->get(),
            'hero' => $hero
        ]);
    }
}
