<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function edit() {
        $profil = \App\Models\Profile::first() ?? new \App\Models\Profile;
        return view('operator.profil.edit', compact('profil'));
    }

    public function update(\Illuminate\Http\Request $request) {
        $request->validate([
            'sejarah' => 'nullable|string',
            'sejarah_timeline' => 'nullable|array',
            'visi' => 'nullable|string',
            'misi' => 'nullable|array',
            'geografi' => 'nullable|string',
            'geografi_stats' => 'nullable|array',
            'batas_wilayah_json' => 'nullable|array',
            'peta_embed' => 'nullable|string',
            'peta_rute_pribadi' => 'nullable|string',
            'peta_rute_umum' => 'nullable|string',
            // V2 Fields
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

        $profil = \App\Models\Profile::first();
        if(!$profil) $profil = new \App\Models\Profile();
        
        $data = $request->except(['peta_image', 'sejarah_image']);
        
        if ($request->hasFile('peta_image')) {
            $path = $request->file('peta_image')->store('public/profil');
            $data['peta_image'] = str_replace('public/', 'storage/', $path);
        }

        if ($request->hasFile('sejarah_image')) {
            $path = $request->file('sejarah_image')->store('public/profil');
            $data['sejarah_image'] = str_replace('public/', 'storage/', $path);
        }

        $profil->fill($data);
        $profil->save();
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Profil Desa (V2)']);
        return back()->with('success', 'Profil Desa berhasil diperbarui!');
    }
}
