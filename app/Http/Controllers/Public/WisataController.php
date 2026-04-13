<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index(Request $request) {
        $query = \App\Models\Wisata::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Filter Kategori
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'terbaru') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'terlama') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort == 'harga_low') {
            $query->orderBy('harga_tiket', 'asc');
        } elseif ($sort == 'harga_high') {
            $query->orderBy('harga_tiket', 'desc');
        } elseif ($sort == 'judul_asc') {
            $query->orderBy('judul', 'asc');
        } elseif ($sort == 'judul_desc') {
            $query->orderBy('judul', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $wisataData = $query->paginate(9)->withQueryString();

        $heroValue = \App\Models\Setting::where('key', 'hero_wisata')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Destinasi Wisata Selorejo', 'subtitle' => 'Jelajahi keajaiban alam dan kearifan agrikultur di lereng pegunungan Malang.', 'icon' => 'mountain'];
        
        return view('public.wisata.index', ['wisata' => $wisataData, 'hero' => $hero]);
    }
}
