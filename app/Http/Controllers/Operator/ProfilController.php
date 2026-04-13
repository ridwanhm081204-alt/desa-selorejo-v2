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
            'peta_deskripsi' => 'nullable|string',
        ]);

        $profil = \App\Models\Profile::first();
        if(!$profil) $profil = new \App\Models\Profile();
        
        $profil->fill($request->all());
        $profil->save();
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Profil Desa (Dinamis)']);
        return back()->with('success', 'Profil Desa berhasil diperbarui!');
    }
}
