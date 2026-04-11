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
            'sejarah' => 'nullable',
            'visi_misi' => 'nullable',
            'geografi' => 'nullable',
            'batas_wilayah' => 'nullable',
            'peta_embed' => 'nullable'
        ]);

        $profil = \App\Models\Profile::first();
        if(!$profil) $profil = new \App\Models\Profile();
        
        $profil->fill($request->all());
        $profil->save();
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Profil Desa']);
        return back()->with('success', 'Profil berhasil diupdate!');
    }
}
