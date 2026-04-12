<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        $galeri = \App\Models\Galeri::when($search, function($query) use ($search) {
                return $query->where('caption', 'like', '%'.$search.'%');
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('public.galeri.index', compact('galeri', 'search'));
    }
}
