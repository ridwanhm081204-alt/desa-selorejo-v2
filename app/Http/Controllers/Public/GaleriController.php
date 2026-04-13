<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request) {
        $query = \App\Models\Galeri::query();

        // Filter: Tipe (Foto/Video)
        if ($request->has('tipe') && $request->tipe != 'semua') {
            $query->where('tipe', $request->tipe);
        }

        // Filter: Kategori (Tag)
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('caption', 'like', '%' . $request->search . '%')
                  ->orWhere('kategori', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'terbaru') {
            $query->orderBy('tanggal', 'desc');
        } elseif ($sort == 'terlama') {
            $query->orderBy('tanggal', 'asc');
        } elseif ($sort == 'judul_asc') {
            $query->orderBy('caption', 'asc');
        } elseif ($sort == 'judul_desc') {
            $query->orderBy('caption', 'desc');
        } else {
            $query->orderBy('tanggal', 'desc');
        }

        $galeri = $query->paginate(12)->withQueryString();

        $heroValue = \App\Models\Setting::where('key', 'hero_galeri')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Galeri Dokumentasi', 'subtitle' => 'Jendela visual potensi dan pesona alami Desa Selorejo', 'icon' => 'image'];

        return view('public.galeri.index', compact('galeri', 'hero'));
    }
}
