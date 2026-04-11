<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;

class StrukturController extends Controller
{
    public function index() {
        $data = StrukturOrganisasi::orderBy('urutan')->get();
        return view('operator.pemerintahan.struktur', compact('data'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'jabatan' => 'required',
            'nama_pejabat' => 'required',
            'urutan' => 'required|integer',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('aparat', 'public');
        }

        StrukturOrganisasi::create($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Aparat: '.$validated['nama_pejabat']]);
        return back()->with('success', 'Data ditambahkan!');
    }

    public function update(Request $request, $id) {
        $struktur = StrukturOrganisasi::findOrFail($id);
        $validated = $request->validate([
            'jabatan' => 'required',
            'nama_pejabat' => 'required',
            'urutan' => 'required|integer',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('aparat', 'public');
        }

        $struktur->update($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Aparat: '.$validated['nama_pejabat']]);
        return back()->with('success', 'Data diupdate!');
    }

    public function destroy($id) {
        $struktur = StrukturOrganisasi::findOrFail($id);
        $struktur->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Aparat']);
        return back()->with('success', 'Data dihapus!');
    }
}
