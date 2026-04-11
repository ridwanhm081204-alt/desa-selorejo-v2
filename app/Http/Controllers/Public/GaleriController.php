<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index() {
        return view('public.galeri.index', ['galeri' => \App\Models\Galeri::orderBy('tanggal', 'desc')->paginate(12)]);
    }
}
