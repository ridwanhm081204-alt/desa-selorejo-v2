<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index(Request $request) {
        $query = \App\Models\Wisata::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        // Filter Kategori
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'terbaru') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'terlama') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort == 'harga_low') {
            $query->orderBy('harga_tiket', 'asc');
        } elseif ($sort == 'harga_high') {
            $query->orderBy('harga_tiket', 'desc');
        } elseif ($sort == 'judul_asc') {
            $query->orderBy('judul', 'asc');
        } elseif ($sort == 'judul_desc') {
            $query->orderBy('judul', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $data = $query->paginate(10)->withQueryString();
        
        $heroValue = \App\Models\Setting::where('key', 'hero_wisata')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Destinasi Wisata Selorejo', 'subtitle' => 'Jelajahi keajaiban alam dan kearifan agrikultur di lereng pegunungan Malang.', 'icon' => 'mountain'];
        return view('operator.wisata.index', compact('data', 'hero'));
    }

    public function create() {
        return view('operator.wisata.form');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'judul' => 'required|string|max:200',
            'kategori' => 'nullable|string|max:50',
            'deskripsi' => 'required',
            'harga_tiket' => 'nullable|numeric',
            'jadwal' => 'nullable',
            'aturan' => 'nullable',
            'whatsapp' => ['nullable', 'string', 'max:16', 'regex:/^\+?[0-9]{8,15}$/'],
            'gambar' => 'required|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
        }

        \App\Models\Wisata::create($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Wisata: '.$data['judul']]);
        return redirect()->route('operator.wisata.index')->with('success', 'Wisata berhasil ditambahkan!');
    }

    public function edit($id) {
        $wisata = \App\Models\Wisata::findOrFail($id);
        return view('operator.wisata.form', compact('wisata'));
    }

    public function update(Request $request, $id) {
        $wisata = \App\Models\Wisata::findOrFail($id);
        $data = $request->validate([
            'judul' => 'required|string|max:200',
            'kategori' => 'nullable|string|max:50',
            'deskripsi' => 'required',
            'harga_tiket' => 'nullable|numeric',
            'jadwal' => 'nullable',
            'aturan' => 'nullable',
            'whatsapp' => ['nullable', 'string', 'max:16', 'regex:/^\+?[0-9]{8,15}$/'],
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            if ($wisata->gambar) {
                Storage::disk('public')->delete($wisata->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
        }

        $wisata->update($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Wisata: '.$data['judul']]);
        return redirect()->route('operator.wisata.index')->with('success', 'Wisata berhasil diperbarui!');
    }

    public function destroy($id) {
        $wisata = \App\Models\Wisata::findOrFail($id);
        
        if ($wisata->gambar) {
            Storage::disk('public')->delete($wisata->gambar);
        }

        $wisata->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Wisata']);
        return back()->with('success', 'Wisata berhasil dihapus!');
    }

    public function updateHero(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        \App\Models\Setting::updateOrCreate(
            ['key' => 'hero_wisata'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header Wisata']);
        return back()->with('success', 'Banner header Wisata berhasil diperbarui!');
    }
}
