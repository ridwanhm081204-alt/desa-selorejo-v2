<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Berita::where('status_publish', 'publish');

        // Filter: Kategori
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'terbaru') {
            $query->orderBy('tanggal', 'desc');
        } elseif ($sort == 'terlama') {
            $query->orderBy('tanggal', 'asc');
        } elseif ($sort == 'judul_asc') {
            $query->orderBy('judul', 'asc');
        } elseif ($sort == 'judul_desc') {
            $query->orderBy('judul', 'desc');
        } else {
            $query->orderBy('tanggal', 'desc');
        }

        $berita = $query->paginate(9)->withQueryString();
        
        $heroValue = \App\Models\Setting::where('key', 'hero_berita')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Kabar Desa', 'subtitle' => 'Informasi, pengumuman, dan liputan terkini dari Desa Selorejo', 'icon' => 'newspaper'];

        return view('public.berita.index', compact('berita', 'hero'));
    }

    public function show($slug) {
        $berita = \App\Models\Berita::where('slug', $slug)->firstOrFail();
        
        // Auto increment views when opened
        $berita->increment('views');

        return view('public.berita.show', compact('berita'));
    }

    public function react(Request $request, $id) {
        $berita = \App\Models\Berita::findOrFail($id);
        $type = $request->input('type'); // 'like' or 'dislike'

        // Check session to prevent multiple reactions from same user session
        $sessionKey = 'reacted_berita_' . $berita->id;
        
        if (session()->has($sessionKey)) {
            return response()->json(['error' => 'Anda sudah memberikan reaksi pada berita ini.'], 400);
        }

        if ($type === 'like') {
            $berita->increment('likes');
        } elseif ($type === 'dislike') {
            $berita->increment('dislikes');
        } else {
            return response()->json(['error' => 'Tipe reaksi tidak valid.'], 400);
        }

        session()->put($sessionKey, $type);

        return response()->json([
            'success' => true, 
            'likes' => $berita->fresh()->likes, 
            'dislikes' => $berita->fresh()->dislikes
        ]);
    }

    public function share($id) {
        $berita = \App\Models\Berita::findOrFail($id);
        
        $sessionKey = 'shared_berita_' . $berita->id;
        if (session()->has($sessionKey)) {
            return response()->json(['success' => true, 'shares' => $berita->shares]);
        }

        $berita->increment('shares');
        session()->put($sessionKey, true);

        return response()->json(['success' => true, 'shares' => $berita->shares]);
    }
}
