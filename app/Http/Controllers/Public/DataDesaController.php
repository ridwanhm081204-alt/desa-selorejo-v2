<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataDesaController extends Controller
{
    public function statistik() {
        return view('public.data.statistik', ['statistik' => \App\Models\StatistikPenduduk::all()]);
    }
    public function apbdes() {
        return view('public.data.apbdes', ['apbdes' => \App\Models\Apbdes::orderBy('tahun', 'desc')->get()]);
    }
}
