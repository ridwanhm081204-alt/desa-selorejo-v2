<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index() {
        return view('operator.produk.index', ['produk' => \App\Models\Produk::paginate(10)]);
    }
    public function create() {
        return view('operator.produk.form');
    }
    public function store(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'gambar' => 'required|image|max:2048'
        ]);
        $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        \App\Models\Produk::create($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Menambahkan Produk: '.$data['nama']]);
        return redirect('/operator/produk')->with('success', 'Produk berhasil ditambahkan!');
    }
    public function edit($id) {
        return view('operator.produk.form', ['produk' => \App\Models\Produk::findOrFail($id)]);
    }
    public function update(\Illuminate\Http\Request $request, $id) {
        $produk = \App\Models\Produk::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048'
        ]);
        if($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }
        $produk->update($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Produk: '.$data['nama']]);
        return redirect('/operator/produk')->with('success', 'Produk berhasil diupdate!');
    }
    public function destroy($id) {
        $produk = \App\Models\Produk::findOrFail($id);
        $produk->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Produk']);
        return back()->with('success', 'Produk dihapus!');
    }
}
