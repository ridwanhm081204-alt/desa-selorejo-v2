<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request) {
        $query = \App\Models\Berita::query();

        // Filter: Kategori
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'terbaru') {
            $query->orderBy('tanggal', 'desc');
        } elseif ($sort == 'terlama') {
            $query->orderBy('tanggal', 'asc');
        } elseif ($sort == 'judul_asc') {
            $query->orderBy('judul', 'asc');
        } elseif ($sort == 'judul_desc') {
            $query->orderBy('judul', 'desc');
        } else {
            $query->orderBy('tanggal', 'desc');
        }

        $berita = $query->paginate(10)->withQueryString();
        
        $heroValue = \App\Models\Setting::where('key', 'hero_berita')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Kabar Desa', 'subtitle' => 'Informasi, pengumuman, dan liputan terkini dari Desa Selorejo', 'icon' => 'newspaper'];

        return view('operator.berita.index', compact('berita', 'hero'));
    }

    public function updateHero(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        \App\Models\Setting::updateOrCreate(
            ['key' => 'hero_berita'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header Berita']);
        return back()->with('success', 'Banner header Berita berhasil diperbarui!');
    }
    public function create() {
        return view('operator.berita.create');
    }
    public function store(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'judul' => 'required|string|max:200|unique:berita,judul',
            'konten' => 'required',
            'kategori' => 'required',
            'tanggal' => 'required|date',
            'status_publish' => 'required',
            'gambar' => 'required|image|max:2048'
        ]);
        $data['slug'] = \Illuminate\Support\Str::slug($data['judul']);
        $data['penulis'] = auth()->user()->name;
        $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        
        \App\Models\Berita::create($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Upload Berita: ' . $data['judul']]);
        return redirect('/operator/berita')->with('success', 'Berita berhasil dibuat!');
    }
    public function show() {}
    public function edit($id) {
        return view('operator.berita.edit', ['berita' => \App\Models\Berita::findOrFail($id)]);
    }
    public function update(\Illuminate\Http\Request $request, $id) {
        $berita = \App\Models\Berita::findOrFail($id);
        $data = $request->validate([
            'judul' => 'required|string|max:200|unique:berita,judul,'.$id,
            'konten' => 'required',
            'kategori' => 'required',
            'tanggal' => 'required|date',
            'status_publish' => 'required',
            'gambar' => 'nullable|image|max:2048'
        ]);
        $data['slug'] = \Illuminate\Support\Str::slug($data['judul']);
        if($request->hasFile('gambar')) {
            // Hapus gambar lama dari storage
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }
        $berita->update($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Berita: ' . $data['judul']]);
        return redirect('/operator/berita')->with('success', 'Berita berhasil diupdate!');
    }
    public function destroy($id) {
        $berita = \App\Models\Berita::findOrFail($id);

        // Hapus file gambar fisik dari storage
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();
        \App\Models\ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'Hapus Berita',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
        return redirect('/operator/berita')->with('success', 'Berita berhasil dihapus!');
    }
}
