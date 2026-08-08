<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\PetaDokumen;
use App\Models\PetaTitik;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function sejarah() {
        return view('public.profil.sejarah', ['profile' => Profile::first()]);
    }
    public function visiMisi() {
        return view('public.profil.visi-misi', ['profile' => Profile::first()]);
    }
    public function geografis() {
        return view('public.profil.geografis', ['profile' => Profile::first()]);
    }
    public function peta() {
        $profile = Profile::first();

        // Peta dokumen: 3 peta (batas desa, destinasi wisata, kawasan wisata UMKM)
        $petaDokumens = PetaDokumen::orderBy('urutan_tampil')->get()->keyBy('slug');

        // 7 destinasi wisata unggulan untuk Section B
        $wisataUnggulan = PetaTitik::with(['umkm', 'wisata'])
            ->where('is_wisata_unggulan', true)
            ->orderBy('urutan_tampil')
            ->orderBy('nama')
            ->get();

        // Semua titik peta untuk Section A, grouped by kategori
        $petaTitikGrouped = PetaTitik::with(['umkm', 'wisata'])
            ->orderBy('nama')
            ->get()
            ->groupBy('kategori');

        return view('public.profil.peta', compact(
            'profile',
            'petaDokumens',
            'wisataUnggulan',
            'petaTitikGrouped'
        ));
    }
}
