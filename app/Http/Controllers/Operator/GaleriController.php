<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request) {
        $query = \App\Models\Galeri::query();

        // Filter: Tipe (Foto/Video)
        if ($request->has('tipe') && $request->tipe != 'semua') {
            $query->where('tipe', $request->tipe);
        }

        // Filter: Kategori (Tag)
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('caption', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'terbaru') {
            $query->orderBy('tanggal', 'desc');
        } elseif ($sort == 'terlama') {
            $query->orderBy('tanggal', 'asc');
        } elseif (in_array($sort, ['judul_asc', 'caption_asc'])) {
            $query->orderBy('caption', 'asc');
        } elseif (in_array($sort, ['judul_desc', 'caption_desc'])) {
            $query->orderBy('caption', 'desc');
        } else {
            $query->orderBy('tanggal', 'desc');
        }

        $galeri = $query->paginate(20)->withQueryString();
        
        $heroValue = \App\Models\Setting::where('key', 'hero_galeri')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Galeri Dokumentasi', 'subtitle' => 'Jendela visual potensi dan pesona alami Desa Selorejo', 'icon' => 'image'];

        return view('operator.galeri.index', compact('galeri', 'hero'));
    }

    public function create() {
        return view('operator.galeri.form');
    }

    public function store(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'tipe' => 'required|in:foto,video',
            'caption' => 'nullable|string|max:200',
            'kategori' => 'nullable|string|max:50',
            'tanggal' => 'required|date'
        ]);
        
        if ($data['tipe'] == 'foto') {
            $request->validate(['file_foto' => 'required|image|max:2048']);
            $data['url'] = $request->file('file_foto')->store('galeri', 'public');
        } else {
            $request->validate(['url_video' => 'required|url']);
            $data['url'] = $request->url_video;
        }

        \App\Models\Galeri::create($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Galeri']);
        return redirect('/operator/galeri')->with('success', 'File berhasil ditambahkan ke galeri!');
    }

    public function edit($id) {
        $galeri = \App\Models\Galeri::findOrFail($id);
        return view('operator.galeri.form', compact('galeri'));
    }

    public function update(Request $request, $id) {
        $galeri = \App\Models\Galeri::findOrFail($id);
        $data = $request->validate([
            'tipe' => 'required|in:foto,video',
            'caption' => 'nullable|string|max:200',
            'kategori' => 'nullable|string|max:50',
            'tanggal' => 'required|date'
        ]);

        if ($data['tipe'] == 'foto') {
            if($request->hasFile('file_foto')) {
                $request->validate(['file_foto' => 'image|max:2048']);
                $data['url'] = $request->file('file_foto')->store('galeri', 'public');
            } else {
                $data['url'] = $galeri->url;
            }
        } else {
            $request->validate(['url_video' => 'required|url']);
            $data['url'] = $request->url_video;
        }

        $galeri->update($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Galeri']);
        return redirect('/operator/galeri')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy($id) {
        $galeri = \App\Models\Galeri::findOrFail($id);

        // Hapus file fisik dari storage jika ada (hanya untuk tipe foto)
        if ($galeri->tipe === 'foto' && $galeri->url) {
            Storage::disk('public')->delete($galeri->url);
        }

        $galeri->delete();
        \App\Models\ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'Hapus Galeri',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
        return redirect('/operator/galeri')->with('success', 'Berhasil menghapus item galeri.');
    }

    public function updateHero(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        \App\Models\Setting::updateOrCreate(
            ['key' => 'hero_galeri'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header Galeri']);
        return back()->with('success', 'Banner header Galeri berhasil diperbarui!');
    }
}
