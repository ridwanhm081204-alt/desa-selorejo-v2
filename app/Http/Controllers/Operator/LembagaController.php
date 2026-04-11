<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LembagaDesa;

class LembagaController extends Controller
{
    public function index() {
        $data = LembagaDesa::all();
        return view('operator.pemerintahan.lembaga', compact('data'));
    }

    public function store(Request $request) {
        $validated = $request->validate(['nama_lembaga' => 'required', 'jenis' => 'required', 'ketua'=>'required', 'deskripsi'=>'nullable']);
        LembagaDesa::create($validated);
        return back()->with('success', 'Data ditambahkan!');
    }

    public function update(Request $request, $id) {
        $lembaga = LembagaDesa::findOrFail($id);
        $validated = $request->validate(['nama_lembaga' => 'required', 'jenis' => 'required', 'ketua'=>'required', 'deskripsi'=>'nullable']);
        $lembaga->update($validated);
        return back()->with('success', 'Data diupdate!');
    }

    public function destroy($id) {
        $lembaga = LembagaDesa::findOrFail($id);
        $lembaga->delete();
        return back()->with('success', 'Data dihapus!');
    }
}
