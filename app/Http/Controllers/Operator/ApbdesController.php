<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApbdesController extends Controller
{
    public function index() {
        return view('operator.apbdes.index', ['apbdes' => \App\Models\Apbdes::orderBy('tahun', 'desc')->paginate(10)]);
    }
    public function create() {
        return view('operator.apbdes.form');
    }
    public function store(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'tahun' => 'required|integer',
            'jenis' => 'required|in:pendapatan,belanja',
            'bidang' => 'required|string',
            'nominal' => 'required|numeric',
            'dokumen_pdf' => 'nullable|file|mimes:pdf|max:5120'
        ]);
        if($request->hasFile('dokumen_pdf')) {
            $data['dokumen_pdf'] = $request->file('dokumen_pdf')->store('apbdes', 'public');
        }
        \App\Models\Apbdes::create($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Data APBDes '.$data['tahun']]);
        return redirect('/operator/apbdes')->with('success', 'Data APBDes ditambahkan!');
    }
    public function edit($id) {
        return view('operator.apbdes.form', ['apbdes' => \App\Models\Apbdes::findOrFail($id)]);
    }
    public function update(\Illuminate\Http\Request $request, $id) {
        $apbdes = \App\Models\Apbdes::findOrFail($id);
        $data = $request->validate([
            'tahun' => 'required|integer',
            'jenis' => 'required|in:pendapatan,belanja',
            'bidang' => 'required|string',
            'nominal' => 'required|numeric',
            'dokumen_pdf' => 'nullable|file|mimes:pdf|max:5120'
        ]);
        if($request->hasFile('dokumen_pdf')) {
            $data['dokumen_pdf'] = $request->file('dokumen_pdf')->store('apbdes', 'public');
        }
        $apbdes->update($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update APBDes']);
        return redirect('/operator/apbdes')->with('success', 'Data diupdate!');
    }
    public function destroy($id) {
        $apbdes = \App\Models\Apbdes::findOrFail($id);
        $apbdes->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus APBDes']);
        return back()->with('success', 'Data dihapus!');
    }
}
