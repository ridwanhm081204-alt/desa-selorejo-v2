<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\PetaDokumen;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetaDokumenController extends Controller
{
    /**
     * Redirect ke operator peta page (editing terjadi di sana via panel).
     */
    public function index()
    {
        return redirect()->route('operator.profil.peta');
    }

    /**
     * Update metadata + ganti file gambar peta.
     */
    public function update(Request $request, string $slug)
    {
        $dokumen = PetaDokumen::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'judul'            => 'required|string|max:200',
            'skala'            => 'nullable|string|max:50',
            'sistem_koordinat' => 'nullable|string|max:100',
            'proyeksi'         => 'nullable|string|max:100',
            'datum'            => 'nullable|string|max:100',
            'sumber_data'      => 'nullable|string',
            'dibuat_oleh'      => 'nullable|string|max:200',
            'urutan_tampil'    => 'nullable|integer|min:0',
            'file_peta'        => 'nullable|image|max:10240', // max 10MB
        ]);

        if ($request->hasFile('file_peta')) {
            // Hapus file lama jika di storage
            if ($dokumen->file_path && str_starts_with($dokumen->file_path, 'storage/')) {
                $oldPath = str_replace('storage/', '', $dokumen->file_path);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('file_peta')->store('peta-dokumen', 'public');
            $validated['file_path'] = 'storage/' . $path;
        }

        unset($validated['file_peta']);
        $dokumen->update($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Peta Dokumen: ' . $dokumen->judul,
        ]);

        return redirect()->route('operator.profil.peta')
                         ->with('success', 'Dokumen peta "' . $dokumen->judul . '" berhasil diperbarui!');
    }
}
