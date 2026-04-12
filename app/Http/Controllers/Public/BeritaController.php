<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        $berita = \App\Models\Berita::where('status_publish', 'publish')
            ->when($search, function($query) use ($search) {
                return $query->where('judul', 'like', '%'.$search.'%');
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('public.berita.index', compact('berita', 'search'));
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
}
