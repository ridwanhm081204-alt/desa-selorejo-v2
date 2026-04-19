<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index(Request $request) {
        $query = \App\Models\Wisata::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
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
    public function show($id) {
        $wisata = \App\Models\Wisata::findOrFail($id);
        
        // Auto increment views
        $wisata->increment('views');
        
        // Rekomendasi wisata lain (opsional, ambil 3 secara acak selain yang sedang dibuka)
        $wisataLain = \App\Models\Wisata::where('id', '!=', $id)->inRandomOrder()->limit(3)->get();
        
        return view('public.wisata.show', compact('wisata', 'wisataLain'));
    }

    public function react(Request $request, $id) {
        $wisata = \App\Models\Wisata::findOrFail($id);
        $type = $request->input('type'); // 'like' or 'dislike'

        // Check session to prevent multiple reactions from same user session
        $sessionKey = 'reacted_wisata_' . $wisata->id;
        
        if (session()->has($sessionKey)) {
            return response()->json(['error' => 'Anda sudah memberikan reaksi pada objek wisata ini.'], 400);
        }

        if ($type === 'like') {
            $wisata->increment('likes');
        } elseif ($type === 'dislike') {
            $wisata->increment('dislikes');
        } else {
            return response()->json(['error' => 'Tipe reaksi tidak valid.'], 400);
        }

        session()->put($sessionKey, $type);

        return response()->json([
            'success' => true, 
            'likes' => $wisata->fresh()->likes, 
            'dislikes' => $wisata->fresh()->dislikes
        ]);
    }

    public function share($id) {
        $wisata = \App\Models\Wisata::findOrFail($id);
        $wisata->increment('shares');
        return response()->json(['success' => true, 'shares' => $wisata->shares]);
    }
}
