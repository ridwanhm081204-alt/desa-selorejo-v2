<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LembagaDesa;
use Illuminate\Support\Facades\Storage;

class LembagaController extends Controller
{
    public function index() {
        $data = LembagaDesa::all();
        $heroValue = \App\Models\Setting::where('key', 'hero_lembaga')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Lembaga Desa', 'subtitle' => 'Lembaga Kemasyarakatan Pendukung Pembangunan Desa', 'icon' => 'building-2'];
        return view('operator.pemerintahan.lembaga', compact('data', 'hero'));
    }

    public function updateHero(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        \App\Models\Setting::updateOrCreate(
            ['key' => 'hero_lembaga'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header Lembaga']);
        return back()->with('success', 'Banner header Lembaga berhasil diperbarui!');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama_lembaga' => 'required', 
            'jenis' => 'required', 
            'ketua' => 'required', 
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('lembaga', 'public');
        }
        LembagaDesa::create($validated);
        return back()->with('success', 'Data ditambahkan!');
    }

    public function update(Request $request, $id) {
        $lembaga = LembagaDesa::findOrFail($id);
        $validated = $request->validate([
            'nama_lembaga' => 'required', 
            'jenis' => 'required', 
            'ketua' => 'required', 
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
        if ($request->hasFile('foto')) {
            if ($lembaga->foto) {
                Storage::disk('public')->delete($lembaga->foto);
            }
            $validated['foto'] = $request->file('foto')->store('lembaga', 'public');
        }
        $lembaga->update($validated);
        return back()->with('success', 'Data diupdate!');
    }

    public function destroy($id) {
        $lembaga = LembagaDesa::findOrFail($id);
        
        if ($lembaga->foto) {
            Storage::disk('public')->delete($lembaga->foto);
        }

        $lembaga->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Lembaga Desa']);
        return back()->with('success', 'Data dihapus!');
    }
}
