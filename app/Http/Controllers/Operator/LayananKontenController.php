<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\LayananKonten;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LayananKontenController extends Controller
{
    // ── Daftar & Edit konten layanan ──
    public function index()
    {
        $layanan = LayananKonten::with(['syarat' => function($q){ 
            $q->orderBy('urutan'); 
        }])->orderBy('urutan')->get();
        return view('operator.layanan.konten', compact('layanan'));
    }

    // ── Update satu layanan ──
    public function update(Request $request, $id)
    {
        $layanan = LayananKonten::findOrFail($id);

        $data = $request->validate([
            'nama'      => 'required|string|max:200',
            'deskripsi' => 'nullable|string|max:1000',
            'warna_hex' => 'nullable|string|max:20',
            'icon_name' => 'nullable|string|max:50',
            'aktif'     => 'nullable|boolean',
            'urutan'    => 'nullable|integer',
        ]);

        $data['aktif'] = $request->boolean('aktif');
        $layanan->update($data);

        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Konten Layanan: ' . $layanan->nama]);

        return back()->with('success', 'Konten layanan "' . $layanan->nama . '" berhasil diperbarui!');
    }

    // ── Update semua layanan sekaligus (batch) ──
    public function updateBatch(Request $request)
    {
        $request->validate([
            'layanan'                 => 'required|array',
            'layanan.*.id'            => 'required|integer|exists:layanan_konten,id',
            'layanan.*.nama'          => 'required|string|max:200',
            'layanan.*.deskripsi'     => 'nullable|string|max:1000',
            'layanan.*.warna_hex'     => 'nullable|string|max:20',
            'layanan.*.icon_name'     => 'nullable|string|max:50',
            'layanan.*.aktif'         => 'nullable',
        ]);

        foreach ($request->layanan as $item) {
            $layanan = LayananKonten::find($item['id']);
            if ($layanan) {
                $layanan->update([
                    'nama'      => $item['nama'],
                    'deskripsi' => $item['deskripsi'] ?? null,
                    'warna_hex' => $item['warna_hex'] ?? $layanan->warna_hex,
                    'icon_name' => $item['icon_name'] ?? $layanan->icon_name,
                    'aktif'     => isset($item['aktif']) ? (bool)$item['aktif'] : true,
                ]);
            }
        }

        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Batch Konten Layanan']);

        return back()->with('success', 'Semua konten layanan berhasil diperbarui!');
    }

    // ── CRUD Syarat Dokumen ──
    public function storeSyarat(Request $request, $id)
    {
        $layanan = LayananKonten::findOrFail($id);

        $data = $request->validate([
            'kode_syarat' => 'required|string|max:100|unique:layanan_syarat,kode_syarat,NULL,id,layanan_konten_id,'.$id,
            'nama_syarat' => 'required|string|max:200',
            'keterangan'  => 'nullable|string|max:500',
            'is_required' => 'nullable|boolean',
            'urutan'      => 'nullable|integer',
        ]);

        $data['is_required'] = $request->boolean('is_required');
        
        $layanan->syarat()->create($data);

        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Syarat Dokumen Layanan: ' . $layanan->nama]);

        return back()->with('success', 'Syarat dokumen berhasil ditambahkan!');
    }

    public function updateSyarat(Request $request, $syarat_id)
    {
        $syarat = \App\Models\LayananSyarat::findOrFail($syarat_id);

        $data = $request->validate([
            'kode_syarat' => 'required|string|max:100|unique:layanan_syarat,kode_syarat,'.$syarat_id.',id,layanan_konten_id,'.$syarat->layanan_konten_id,
            'nama_syarat' => 'required|string|max:200',
            'keterangan'  => 'nullable|string|max:500',
            'is_required' => 'nullable|boolean',
            'urutan'      => 'nullable|integer',
        ]);

        $data['is_required'] = $request->boolean('is_required');

        $syarat->update($data);

        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Syarat Dokumen Layanan: ' . $syarat->layananKonten->nama]);

        return back()->with('success', 'Syarat dokumen berhasil diperbarui!');
    }

    public function destroySyarat($syarat_id)
    {
        $syarat = \App\Models\LayananSyarat::findOrFail($syarat_id);
        $layananNama = $syarat->layananKonten->nama;
        
        $syarat->delete();

        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Syarat Dokumen Layanan: ' . $layananNama]);

        return back()->with('success', 'Syarat dokumen berhasil dihapus!');
    }
}
