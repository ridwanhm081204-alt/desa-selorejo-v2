<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataDesaController extends Controller
{
    public function statistik() {
        $statistik = \App\Models\StatistikPenduduk::all()->groupBy('jenis_data');
        return view('public.data.statistik', compact('statistik'));
    }
    public function apbdes() {
        return view('public.data.apbdes', ['apbdes' => \App\Models\Apbdes::orderBy('tahun', 'desc')->get()]);
    }
}
