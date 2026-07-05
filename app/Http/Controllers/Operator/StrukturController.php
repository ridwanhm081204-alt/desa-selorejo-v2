<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    public function index() {
        $data = StrukturOrganisasi::orderBy('urutan')->get();
        $heroValue = \App\Models\Setting::where('key', 'hero_struktur')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Struktur Organisasi', 'subtitle' => 'Jajaran Perangkat Desa Selorejo Periode Terkini', 'icon' => 'network'];
        return view('operator.pemerintahan.struktur', compact('data', 'hero'));
    }

    public function updateHero(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        \App\Models\Setting::updateOrCreate(
            ['key' => 'hero_struktur'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header Struktur']);
        return back()->with('success', 'Banner header struktur berhasil diperbarui!');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'jabatan' => 'required',
            'nama_pejabat' => 'required',
            'urutan' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('aparat', 'public');
        }

        StrukturOrganisasi::create($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Aparat: '.$validated['nama_pejabat']]);
        return back()->with('success', 'Data ditambahkan!');
    }

    public function update(Request $request, $id) {
        $struktur = StrukturOrganisasi::findOrFail($id);
        $validated = $request->validate([
            'jabatan' => 'required',
            'nama_pejabat' => 'required',
            'urutan' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('aparat', 'public');
        }

        $struktur->update($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Aparat: '.$validated['nama_pejabat']]);
        return back()->with('success', 'Data diupdate!');
    }

    public function destroy($id) {
        $struktur = StrukturOrganisasi::findOrFail($id);
        
        if ($struktur->foto) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Aparat']);
        return back()->with('success', 'Data dihapus!');
    }
}
