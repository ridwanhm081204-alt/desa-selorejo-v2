<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index() {
        return view('operator.galeri.index', ['galeri' => \App\Models\Galeri::orderBy('tanggal', 'desc')->paginate(20)]);
    }
    public function create() {
        return view('operator.galeri.create');
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
    public function destroy($id) {
        $galeri = \App\Models\Galeri::findOrFail($id);
        $galeri->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Galeri']);
        return redirect('/operator/galeri')->with('success', 'Berhasil menghapus item galeri.');
    }
}
