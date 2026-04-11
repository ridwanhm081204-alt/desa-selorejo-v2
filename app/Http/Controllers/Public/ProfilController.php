<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function sejarah() {
        return view('public.profil.sejarah', ['profile' => \App\Models\Profile::first()]);
    }
    public function visiMisi() {
        return view('public.profil.visi-misi', ['profile' => \App\Models\Profile::first()]);
    }
    public function geografis() {
        return view('public.profil.geografis', ['profile' => \App\Models\Profile::first()]);
    }
    public function peta() {
        return view('public.profil.peta', ['profile' => \App\Models\Profile::first()]);
    }
}
