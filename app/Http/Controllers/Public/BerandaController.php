<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $berita = \App\Models\Berita::where('status_publish', 'publish')->orderBy('tanggal', 'desc')->take(6)->get();
        $wisata = \App\Models\Wisata::first();
        $widgetAparat = \App\Models\WidgetAparat::first();
        $polling = \App\Models\Polling::where('is_active', true)->where('tanggal_selesai', '>=', now()->toDateString())->first();
        $produk = \App\Models\Produk::take(9)->get();
        $galeri = \App\Models\Galeri::where('tipe', 'foto')->orderBy('tanggal', 'desc')->take(6)->get();
        $profile = \App\Models\Profile::first();
        $tautanTerkait = \App\Models\TautanTerkait::all();

        return view('public.beranda', compact('berita', 'wisata', 'widgetAparat', 'polling', 'produk', 'galeri', 'profile', 'tautanTerkait'));
    }

    public function vote(\Illuminate\Http\Request $request, $id)
    {
        $polling = \App\Models\Polling::findOrFail($id);
        
        if ($request->cookie('voted_polling_' . $id)) {
            return back()->with('error', 'Anda sudah pernah mengisi polling ini.');
        }

        if ($request->answer == 'ya') {
            $polling->increment('jumlah_ya');
        } elseif ($request->answer == 'tidak') {
            $polling->increment('jumlah_tidak');
        }

        return back()->with('success', 'Terima kasih atas partisipasi Anda!')->cookie('voted_polling_'.$id, true, 1440); // cookie for 1 day
    }
}
