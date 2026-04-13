<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataDesaController extends Controller
{
    public function statistik() {
        $statistik = \App\Models\StatistikPenduduk::all()->groupBy('jenis_data');
        $heroValue = \App\Models\Setting::where('key', 'hero_statistik')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Statistik Demografi Desa', 'subtitle' => 'Transparansi data penduduk Desa Wisata Selorejo berdasarkan angka riil kependudukan.', 'icon' => 'bar-chart-2'];
        return view('public.data.statistik', compact('statistik', 'hero'));
    }
    public function apbdes() {
        $heroValue = \App\Models\Setting::where('key', 'hero_apbdes')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Transparansi APBDes', 'subtitle' => 'Laporan Anggaran Pendapatan dan Belanja Desa Selorejo Tahun Anggaran 2024.', 'icon' => 'file-text'];
        return view('public.data.apbdes', ['apbdes' => \App\Models\Apbdes::orderBy('tahun', 'desc')->get(), 'hero' => $hero]);
    }
}
