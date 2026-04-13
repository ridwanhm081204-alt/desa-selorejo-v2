<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bpd;

class BpdController extends Controller
{
    public function index() {
        $data = Bpd::all();
        $heroValue = \App\Models\Setting::where('key', 'hero_bpd')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Badan Permusyawaratan Desa', 'subtitle' => 'Lembaga legislatif desa sebagai mitra Pemerintah Desa.', 'icon' => 'users-2'];
        return view('operator.pemerintahan.bpd', compact('data', 'hero'));
    }

    public function updateHero(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        \App\Models\Setting::updateOrCreate(
            ['key' => 'hero_bpd'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header BPD']);
        return back()->with('success', 'Banner header BPD berhasil diperbarui!');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required', 
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('aparat', 'public');
        }
        Bpd::create($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Anggota BPD: '.$validated['nama']]);
        return back()->with('success', 'Data ditambahkan!');
    }

    public function update(Request $request, $id) {
        $bpd = Bpd::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required', 
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('aparat', 'public');
        }
        $bpd->update($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update BPD: '.$validated['nama']]);
        return back()->with('success', 'Data diupdate!');
    }

    public function destroy($id) {
        $bpd = Bpd::findOrFail($id);
        $bpd->delete();
        return back()->with('success', 'Data dihapus!');
    }
}
