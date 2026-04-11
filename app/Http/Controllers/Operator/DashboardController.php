<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $jumlahBerita = \App\Models\Berita::count();
        $jumlahPesan = \App\Models\KontakMessage::where('status_baca','belum')->count();
        $jumlahGaleri = \App\Models\Galeri::count();
        $jumlahProduk = \App\Models\Produk::count();
        return view('operator.dashboard', compact('jumlahBerita', 'jumlahPesan', 'jumlahGaleri', 'jumlahProduk'));
    }
}
