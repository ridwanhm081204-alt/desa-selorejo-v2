<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $berita = \App\Models\Berita::where('status_publish', 'publish')->orderBy('tanggal', 'desc')->get();
        $wisata = \App\Models\Wisata::first();
        $widgetAparat = \App\Models\WidgetAparat::first();
        $pollings = \App\Models\Polling::where('is_active', true)->where('tanggal_selesai', '>=', now()->toDateString())->get();
        $heroPollingValue = \App\Models\Setting::where('key', 'hero_polling')->value('value');
        $heroPolling = $heroPollingValue ? json_decode($heroPollingValue, true) : ['title' => 'Jejak Pendapat', 'subtitle' => 'Suara Anda sangat berarti bagi kemajuan desa kami.', 'icon' => 'pie-chart'];
        $produk = \App\Models\Produk::orderBy('id', 'desc')->get();
        $galeri = \App\Models\Galeri::where('tipe', 'foto')->orderBy('tanggal', 'desc')->get();
        $profile = \App\Models\Profile::first();
        $tautanTerkait = \App\Models\TautanTerkait::all();

        return view('public.beranda', compact('berita', 'wisata', 'widgetAparat', 'pollings', 'produk', 'galeri', 'profile', 'tautanTerkait', 'heroPolling'));
    }

    public function vote(\Illuminate\Http\Request $request, $id)
    {
        $polling = \App\Models\Polling::findOrFail($id);
        
        $cacheKey = 'voted_polling_' . $id . '_' . $request->ip();
        if ($request->cookie('voted_polling_' . $id) || \Illuminate\Support\Facades\Cache::has($cacheKey)) {
            return back()->with(['error' => 'Anda sudah pernah mengisi polling ini.', 'polling_id' => $id]);
        }

        if ($request->answer == 'ya') {
            $polling->increment('jumlah_ya');
        } elseif ($request->answer == 'tidak') {
            $polling->increment('jumlah_tidak');
        }

        // Simpan cache selama 24 jam (1440 menit) untuk mencegah bypass cookie
        \Illuminate\Support\Facades\Cache::put($cacheKey, true, now()->addDay());

        return back()->with(['success' => 'Terima kasih atas partisipasi Anda!', 'polling_id' => $id])->cookie('voted_polling_'.$id, true, 1440); // cookie for 1 day
    }
}
