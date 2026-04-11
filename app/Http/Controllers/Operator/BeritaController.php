<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index() {
        return view('operator.berita.index', ['berita' => \App\Models\Berita::orderBy('tanggal', 'desc')->paginate(10)]);
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
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }
        $berita->update($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Berita: ' . $data['judul']]);
        return redirect('/operator/berita')->with('success', 'Berita berhasil diupdate!');
    }
    public function destroy($id) {
        $berita = \App\Models\Berita::findOrFail($id);
        $berita->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Berita']);
        return redirect('/operator/berita')->with('success', 'Berita berhasil dihapus!');
    }
}
