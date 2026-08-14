<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Berita;
use App\Models\BeritaFoto;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
        }

        $sort = $request->get('sort', 'terbaru');
        match($sort) {
            'terlama'    => $query->orderBy('tanggal', 'asc'),
            'judul_asc'  => $query->orderBy('judul', 'asc'),
            'judul_desc' => $query->orderBy('judul', 'desc'),
            default      => $query->orderBy('tanggal', 'desc'),
        };

        $berita = $query->paginate(10)->withQueryString();

        $heroValue = Setting::where('key', 'hero_berita')->value('value');
        $hero = $heroValue
            ? json_decode($heroValue, true)
            : ['title' => 'Kabar Desa', 'subtitle' => 'Informasi, pengumuman, dan liputan terkini dari Desa Selorejo', 'icon' => 'newspaper'];

        return view('operator.berita.index', compact('berita', 'hero'));
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'title'    => 'required|string',
            'subtitle' => 'required|string',
            'icon'     => 'required|string',
        ]);

        Setting::updateOrCreate(
            ['key' => 'hero_berita'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );

        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header Berita']);
        return back()->with('success', 'Banner header Berita berhasil diperbarui!');
    }

    public function create()
    {
        return view('operator.berita.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'          => 'required|string|max:200|unique:berita,judul',
            'konten'         => 'required',
            'kategori'       => 'required',
            'tanggal'        => 'required|date',
            'status_publish' => 'required',
            'fotos'          => 'required|array|min:1|max:10',
            'fotos.*'        => 'image|max:5120',
        ]);

        $data['slug']    = Str::slug($data['judul']);
        $data['penulis'] = auth()->user()->name ?? 'Operator Desa';

        // Sanitasi konten HTML
        $allowedTags = '<p><br><b><i><strong><em><u><s><ul><ol><li><h2><h3><h4><h5><h6><a><img><blockquote><pre><code><table><thead><tbody><tr><th><td><span><div>';
        $data['konten'] = strip_tags($data['konten'], $allowedTags);

        // Ambil file-file yang diupload
        $uploadedFiles = $request->file('fotos');

        // Simpan foto pertama sebagai cover (kolom gambar)
        $data['gambar'] = $uploadedFiles[0]->store('berita', 'public');

        // Hapus key fotos sebelum create (bukan kolom DB)
        unset($data['fotos']);

        $berita = Berita::create($data);

        // Simpan semua foto ke tabel berita_foto
        foreach ($uploadedFiles as $index => $file) {
            $path = ($index === 0) ? $data['gambar'] : $file->store('berita', 'public');
            BeritaFoto::create([
                'berita_id' => $berita->id,
                'path'      => $path,
                'urutan'    => $index,
            ]);
        }

        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Upload Berita: ' . $data['judul']]);
        return redirect('/operator/berita')->with('success', 'Berita berhasil dibuat!');
    }

    public function show() {}

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('operator.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $data = $request->validate([
            'judul'          => 'required|string|max:200|unique:berita,judul,' . $id,
            'konten'         => 'required',
            'kategori'       => 'required',
            'tanggal'        => 'required|date',
            'status_publish' => 'required',
            'fotos'          => 'nullable|array|max:10',
            'fotos.*'        => 'image|max:5120',
            'hapus_foto'     => 'nullable|array',
            'hapus_foto.*'   => 'integer',
            'hapus_legacy_cover' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['judul']);

        // Sanitasi konten HTML
        $allowedTags = '<p><br><b><i><strong><em><u><s><ul><ol><li><h2><h3><h4><h5><h6><a><img><blockquote><pre><code><table><thead><tbody><tr><th><td><span><div>';
        $data['konten'] = strip_tags($data['konten'], $allowedTags);

        // 1) Hapus foto yang dipilih user untuk dihapus dari berita_foto
        if (!empty($data['hapus_foto'])) {
            foreach ($data['hapus_foto'] as $fotoId) {
                $foto = BeritaFoto::where('id', $fotoId)->where('berita_id', $berita->id)->first();
                if ($foto) {
                    if (!Str::startsWith($foto->path, ['images/', 'http://', 'https://'])) {
                        Storage::disk('public')->delete($foto->path);
                    }
                    $foto->delete();
                }
            }
        }

        // 2) Hapus legacy single cover jika dipilih
        if (!empty($request->hapus_legacy_cover)) {
            if ($berita->gambar && !Str::startsWith($berita->gambar, ['images/', 'http://', 'https://'])) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $berita->gambar = null;
        }

        // 3) Upload foto baru jika ada
        if ($request->hasFile('fotos')) {
            $existingCount = $berita->fotos()->count();
            $maxBaru = 10 - $existingCount;

            foreach (array_slice($request->file('fotos'), 0, max(0, $maxBaru)) as $file) {
                $path = $file->store('berita', 'public');
                BeritaFoto::create([
                    'berita_id' => $berita->id,
                    'path'      => $path,
                    'urutan'    => $existingCount++,
                ]);
            }
        }

        // 4) Re-order urutan foto setelah perubahan
        $berita->fotos()->orderBy('urutan')->orderBy('id')->get()->each(function ($foto, $index) {
            $foto->update(['urutan' => $index]);
        });

        // 5) Update cover (kolom gambar) dari foto pertama yang tersisa
        $firstFoto = $berita->fotos()->orderBy('urutan')->first();
        if ($firstFoto) {
            $data['gambar'] = $firstFoto->path;
        } elseif ($berita->gambar) {
            $data['gambar'] = $berita->gambar;
        } else {
            $data['gambar'] = 'images/hero_desa.png';
        }

        // 6) Bersihkan key yang bukan kolom DB sebelum update
        unset($data['fotos'], $data['hapus_foto'], $data['hapus_legacy_cover']);

        $berita->update($data);

        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Berita: ' . $data['judul']]);
        return redirect('/operator/berita')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus semua foto dari storage
        foreach ($berita->fotos as $foto) {
            Storage::disk('public')->delete($foto->path);
        }
        $berita->fotos()->delete();

        // Hapus cover lama jika ada (untuk berita lama yang belum punya berita_foto)
        if ($berita->gambar && !$berita->fotos()->exists()) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'Hapus Berita',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
        return redirect('/operator/berita')->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Hapus satu foto dari berita (direct delete via route, bisa dipakai masa depan).
     */
    public function destroyFoto($beritaId, $fotoId)
    {
        $berita = Berita::findOrFail($beritaId);
        $foto   = BeritaFoto::where('id', $fotoId)->where('berita_id', $berita->id)->firstOrFail();

        // Jangan hapus jika hanya tinggal 1 foto
        if ($berita->fotos()->count() <= 1) {
            return back()->with('error', 'Berita harus memiliki minimal 1 foto!');
        }

        Storage::disk('public')->delete($foto->path);
        $foto->delete();

        // Re-order dan update cover
        $berita->fotos()->orderBy('id')->get()->each(function ($f, $index) {
            $f->update(['urutan' => $index]);
        });

        $firstFoto = $berita->fotos()->orderBy('urutan')->first();
        if ($firstFoto) {
            $berita->update(['gambar' => $firstFoto->path]);
        }

        return back()->with('success', 'Foto berhasil dihapus!');
    }
}
