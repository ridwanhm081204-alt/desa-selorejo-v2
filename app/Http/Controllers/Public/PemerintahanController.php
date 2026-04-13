<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemerintahanController extends Controller
{
    public function struktur() {
        $heroValue = \App\Models\Setting::where('key', 'hero_struktur')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Struktur Organisasi', 'subtitle' => 'Jajaran Perangkat Desa Selorejo Periode Terkini', 'icon' => 'network'];
        return view('public.pemerintahan.struktur', [
            'struktur' => \App\Models\StrukturOrganisasi::orderBy('urutan')->get(),
            'hero' => $hero
        ]);
    }
    public function bpd() {
        $heroValue = \App\Models\Setting::where('key', 'hero_bpd')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Badan Permusyawaratan Desa', 'subtitle' => 'Lembaga legislatif desa sebagai mitra Pemerintah Desa.', 'icon' => 'users-2'];
        return view('public.pemerintahan.bpd', [
            'bpd' => \App\Models\Bpd::all(),
            'hero' => $hero
        ]);
    }
    public function lembaga() {
        $heroValue = \App\Models\Setting::where('key', 'hero_lembaga')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Lembaga Desa', 'subtitle' => 'Lembaga Kemasyarakatan Pendukung Pembangunan Desa', 'icon' => 'building-2'];
        return view('public.pemerintahan.lembaga', [
            'lembaga' => \App\Models\LembagaDesa::all(),
            'hero' => $hero
        ]);
    }
}
