<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index() {
        return view('public.berita.index', ['berita' => \App\Models\Berita::where('status_publish', 'publish')->orderBy('tanggal', 'desc')->paginate(9)]);
    }
    public function show($slug) {
        return view('public.berita.show', ['berita' => \App\Models\Berita::where('slug', $slug)->firstOrFail()]);
    }
}
