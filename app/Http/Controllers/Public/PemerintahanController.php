<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemerintahanController extends Controller
{
    public function struktur() {
        return view('public.pemerintahan.struktur', ['struktur' => \App\Models\StrukturOrganisasi::orderBy('urutan')->get()]);
    }
    public function bpd() {
        return view('public.pemerintahan.bpd', ['bpd' => \App\Models\Bpd::all()]);
    }
    public function lembaga() {
        return view('public.pemerintahan.lembaga', ['lembaga' => \App\Models\LembagaDesa::all()]);
    }
}
