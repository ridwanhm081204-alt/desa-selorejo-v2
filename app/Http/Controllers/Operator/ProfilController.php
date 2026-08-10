<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function sejarah() {
        $profil = \App\Models\Profile::first() ?? new \App\Models\Profile;
        return view('operator.profil.sejarah', compact('profil'));
    }

    public function visiMisi() {
        $profil = \App\Models\Profile::first() ?? new \App\Models\Profile;
        return view('operator.profil.visi-misi', compact('profil'));
    }

    public function geografis() {
        $profil = \App\Models\Profile::first() ?? new \App\Models\Profile;
        return view('operator.profil.geografis', compact('profil'));
    }

    public function peta(Request $request) {
        $profil = \App\Models\Profile::first() ?? new \App\Models\Profile;
        $petaDokumens = \App\Models\PetaDokumen::orderBy('urutan_tampil')->get()->keyBy('slug');
        
        $query = \App\Models\PetaTitik::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama', 'like', "%{$s}%")
                  ->orWhere('deskripsi', 'like', "%{$s}%");
            });
        }

        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('dusun') && $request->dusun !== 'semua') {
            $query->where('dusun', $request->dusun);
        }

        $petaTitiks = $query->orderBy('urutan_tampil')->orderBy('nama')->paginate(15)->withQueryString();

        $petaTitikStats = [
            'total'    => \App\Models\PetaTitik::count(),
            'unggulan' => \App\Models\PetaTitik::where('is_wisata_unggulan', true)->count(),
        ];
        return view('operator.profil.peta', compact('profil', 'petaDokumens', 'petaTitiks', 'petaTitikStats'));
    }

    public function update(Request $request) {
        $request->validate([
            'sejarah' => 'nullable|string',
            'sejarah_timeline' => 'nullable|array',
            'visi' => 'nullable|string',
            'misi' => 'nullable|array',
            'geografi' => 'nullable|string',
            'geografi_stats' => 'nullable|array',
            'batas_wilayah_json' => 'nullable|array',
            'peta_embed' => [
                'nullable',
                'string',
                'max:2000',
                function ($attribute, $value, $fail) {
                    if (!$value) return;
                    $trimmed = trim($value);
                    if (!str_starts_with($trimmed, '<iframe')) {
                        $fail('Kode peta harus berupa tag iframe Google Maps yang valid.');
                        return;
                    }
                    if (!preg_match('#src=["\']https://(?:www\.)?google\.com/maps#i', $trimmed) &&
                        !preg_match('#src=["\']https://maps\.google\.com#i', $trimmed)) {
                        $fail('Kode peta hanya diperbolehkan dari Google Maps.');
                    }
                }
            ],
            'peta_rute_pribadi' => 'nullable|string|max:2000',
            'peta_rute_umum' => 'nullable|string|max:2000',
            'hero_sejarah' => 'nullable|array',
            'hero_visimisi' => 'nullable|array',
            'hero_geografi' => 'nullable|array',
            'hero_peta' => 'nullable|array',
            'motto' => 'nullable|string',
            'dusun_info' => 'nullable|array',
            'peta_image' => 'nullable|image|max:2048',
            'sejarah_image' => 'nullable|image|max:2048',
            'peta_narasi_utama' => 'nullable|string',
            'peta_narasi_legenda' => 'nullable|string',
            'peta_fasilitas' => 'nullable|array',
        ]);

        if ($request->filled('peta_embed')) {
            $request->merge([
                'peta_embed' => strip_tags(trim($request->peta_embed), '<iframe>')
            ]);
        }

        $profil = \App\Models\Profile::first();
        if(!$profil) $profil = new \App\Models\Profile();
        
        $data = $request->except(['peta_image', 'sejarah_image']);
        
        if ($request->hasFile('peta_image')) {
            if (!empty($profil->peta_image) && str_starts_with($profil->peta_image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $profil->peta_image);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('peta_image')->store('profil', 'public');
            $data['peta_image'] = 'storage/' . $path;
        }

        if ($request->hasFile('sejarah_image')) {
            if (!empty($profil->sejarah_image) && str_starts_with($profil->sejarah_image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $profil->sejarah_image);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('sejarah_image')->store('profil', 'public');
            $data['sejarah_image'] = 'storage/' . $path;
        }

        $profil->fill($data);
        $profil->save();

        return redirect()->back()->with('success', 'Data profil berhasil diperbarui!');
    }
}
