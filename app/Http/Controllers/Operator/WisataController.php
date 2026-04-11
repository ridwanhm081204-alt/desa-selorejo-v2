<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function edit() {
        $wisata = \App\Models\Wisata::first() ?? new \App\Models\Wisata;
        return view('operator.wisata.edit', compact('wisata'));
    }

    public function update(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required',
            'harga_tiket' => 'nullable|numeric',
            'jadwal' => 'nullable',
            'aturan' => 'nullable',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $wisata = \App\Models\Wisata::first();
        if(!$wisata) $wisata = new \App\Models\Wisata();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
        }

        $wisata->fill($data);
        $wisata->save();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Wisata Desa']);
        
        return back()->with('success', 'Data Wisata berhasil diupdate!');
    }
}
