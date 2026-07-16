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

    public function perangkatRtRw() {
        $heroValue = \App\Models\Setting::where('key', 'hero_perangkat_rt_rw')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Perangkat RT & RW', 'subtitle' => 'Daftar Ketua RT dan RW Desa Selorejo', 'icon' => 'map-pin'];

        $allData = \App\Models\PerangkatRtRw::orderBy('urutan')->get();

        // Semua RW, diurutkan
        $rwList = $allData->where('jenis', 'RW')->sortBy('nomor');

        // RT dikelompokkan per nomor_rw
        $rtByRw = $allData->where('jenis', 'RT')->groupBy('nomor_rw');

        // Total untuk statistik
        $totalRt = $allData->where('jenis', 'RT')->count();
        $totalRw = $rwList->count();

        return view('public.pemerintahan.perangkat_rt_rw', compact('hero', 'rwList', 'rtByRw', 'totalRt', 'totalRw'));
    }

    public function produkHukum() {
        $heroValue = \App\Models\Setting::where('key', 'hero_produk_hukum')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Produk Hukum', 'subtitle' => 'Kumpulan Peraturan Desa, Keputusan Kepala Desa, dan Dokumen Hukum Lainnya.', 'icon' => 'scale'];
        
        $produkHukum = \App\Models\ProdukHukum::orderBy('tanggal_ditetapkan', 'desc')->get();
        return view('public.pemerintahan.produk_hukum', compact('produkHukum', 'hero'));
    }
}
