<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bpd;

class BpdController extends Controller
{
    public function index() {
        $data = Bpd::all();
        return view('operator.pemerintahan.bpd', compact('data'));
    }

    public function store(Request $request) {
        $validated = $request->validate(['nama' => 'required', 'jabatan' => 'required']);
        Bpd::create($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Anggota BPD: '.$validated['nama']]);
        return back()->with('success', 'Data ditambahkan!');
    }

    public function update(Request $request, $id) {
        $bpd = Bpd::findOrFail($id);
        $validated = $request->validate(['nama' => 'required', 'jabatan' => 'required']);
        $bpd->update($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update BPD: '.$validated['nama']]);
        return back()->with('success', 'Data diupdate!');
    }

    public function destroy($id) {
        $bpd = Bpd::findOrFail($id);
        $bpd->delete();
        return back()->with('success', 'Data dihapus!');
    }
}
