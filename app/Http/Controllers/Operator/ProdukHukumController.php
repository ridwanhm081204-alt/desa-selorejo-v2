<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdukHukum;
use Illuminate\Support\Facades\Storage;

class ProdukHukumController extends Controller
{
    public function index() {
        $data = ProdukHukum::orderBy('tanggal_ditetapkan', 'desc')->get();
        $heroValue = \App\Models\Setting::where('key', 'hero_produk_hukum')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Produk Hukum', 'subtitle' => 'Kumpulan Peraturan Desa, Keputusan Kepala Desa, dan Dokumen Hukum Lainnya.', 'icon' => 'scale'];
        return view('operator.pemerintahan.produk_hukum', compact('data', 'hero'));
    }

    public function updateHero(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        \App\Models\Setting::updateOrCreate(
            ['key' => 'hero_produk_hukum'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header Produk Hukum']);
        return back()->with('success', 'Banner header Produk Hukum berhasil diperbarui!');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'judul' => 'required|string|max:255', 
            'jenis' => 'required|string|max:100',
            'tahun' => 'required|integer',
            'tanggal_ditetapkan' => 'nullable|date',
            'dokumen_pdf' => 'nullable|file|mimes:pdf|max:10240', // 10MB max
            'konten' => 'nullable|string'
        ]);

        if ($request->hasFile('dokumen_pdf')) {
            $validated['dokumen_pdf'] = $request->file('dokumen_pdf')->store('produk_hukum', 'public');
        }

        ProdukHukum::create($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Produk Hukum: '.$validated['judul']]);
        return back()->with('success', 'Data ditambahkan!');
    }

    public function update(Request $request, $id) {
        $produkHukum = ProdukHukum::findOrFail($id);
        $validated = $request->validate([
            'judul' => 'required|string|max:255', 
            'jenis' => 'required|string|max:100',
            'tahun' => 'required|integer',
            'tanggal_ditetapkan' => 'nullable|date',
            'dokumen_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'konten' => 'nullable|string'
        ]);

        if ($request->hasFile('dokumen_pdf')) {
            if ($produkHukum->dokumen_pdf) {
                Storage::disk('public')->delete($produkHukum->dokumen_pdf);
            }
            $validated['dokumen_pdf'] = $request->file('dokumen_pdf')->store('produk_hukum', 'public');
        }

        $produkHukum->update($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Produk Hukum: '.$validated['judul']]);
        return back()->with('success', 'Data diupdate!');
    }

    public function destroy($id) {
        $produkHukum = ProdukHukum::findOrFail($id);
        
        if ($produkHukum->dokumen_pdf) {
            Storage::disk('public')->delete($produkHukum->dokumen_pdf);
        }

        $produkHukum->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Produk Hukum']);
        return back()->with('success', 'Data dihapus!');
    }
}
