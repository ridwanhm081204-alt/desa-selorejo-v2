<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\PetaTitik;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetaTitikController extends Controller
{
    public function index(Request $request)
    {
        $query = PetaTitik::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama', 'like', "%{$s}%")
                  ->orWhere('deskripsi', 'like', "%{$s}%");
            });
        }

        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('dusun') && $request->dusun !== 'semua') {
            $query->where('dusun', $request->dusun);
        }

        if ($request->filled('unggulan')) {
            $query->where('is_wisata_unggulan', (bool) $request->unggulan);
        }

        $data = $query->orderBy('urutan_tampil')->orderBy('nama')->paginate(15)->withQueryString();

        $stats = [
            'total'    => PetaTitik::count(),
            'unggulan' => PetaTitik::where('is_wisata_unggulan', true)->count(),
        ];

        return view('operator.peta-titik.index', compact('data', 'stats'));
    }

    public function create()
    {
        return view('operator.peta-titik.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:200',
            'kategori'          => 'required|in:' . implode(',', array_keys(PetaTitik::KATEGORI_LIST)),
            'dusun'             => 'required|in:' . implode(',', PetaTitik::DUSUN_LIST),
            'deskripsi'         => 'nullable|string',
            'latitude'          => 'nullable|numeric|between:-90,90',
            'longitude'         => 'nullable|numeric|between:-180,180',
            'is_wisata_unggulan'=> 'boolean',
            'sumber_data'       => 'nullable|string|max:300',
            'urutan_tampil'     => 'nullable|integer|min:0',
            'umkm_id'           => 'nullable|exists:umkms,id',
            'wisata_id'         => 'nullable|exists:wisata,id',
            'foto'              => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('peta-titik', 'public');
        }

        $validated['is_wisata_unggulan'] = $request->boolean('is_wisata_unggulan');

        $titik = PetaTitik::create($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Tambah Titik Peta: ' . $titik->nama,
        ]);

        return redirect()->route('operator.profil.peta', ['tab' => 'titik'])
                         ->with('success', 'Titik peta "' . $titik->nama . '" berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $titik = PetaTitik::findOrFail($id);
        return view('operator.peta-titik.form', compact('titik'));
    }

    public function update(Request $request, $id)
    {
        $titik = PetaTitik::findOrFail($id);

        $validated = $request->validate([
            'nama'              => 'required|string|max:200',
            'kategori'          => 'required|in:' . implode(',', array_keys(PetaTitik::KATEGORI_LIST)),
            'dusun'             => 'required|in:' . implode(',', PetaTitik::DUSUN_LIST),
            'deskripsi'         => 'nullable|string',
            'latitude'          => 'nullable|numeric|between:-90,90',
            'longitude'         => 'nullable|numeric|between:-180,180',
            'is_wisata_unggulan'=> 'boolean',
            'sumber_data'       => 'nullable|string|max:300',
            'urutan_tampil'     => 'nullable|integer|min:0',
            'umkm_id'           => 'nullable|exists:umkms,id',
            'wisata_id'         => 'nullable|exists:wisata,id',
            'foto'              => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('foto')) {
            if ($titik->foto && !str_starts_with($titik->foto, 'http')) {
                Storage::disk('public')->delete($titik->foto);
            }
            $validated['foto'] = $request->file('foto')->store('peta-titik', 'public');
        }

        $validated['is_wisata_unggulan'] = $request->boolean('is_wisata_unggulan');

        $titik->update($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Titik Peta: ' . $titik->nama,
        ]);

        return redirect()->route('operator.profil.peta', ['tab' => 'titik'])
                         ->with('success', 'Titik peta "' . $titik->nama . '" berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $titik = PetaTitik::findOrFail($id);
        $nama = $titik->nama;

        if ($titik->foto && !str_starts_with($titik->foto, 'http')) {
            Storage::disk('public')->delete($titik->foto);
        }

        $titik->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Hapus Titik Peta: ' . $nama,
        ]);

        return redirect()->route('operator.profil.peta')
                         ->with('success', 'Titik peta "' . $nama . '" berhasil dihapus!');
    }

    public function toggleUnggulan($id)
    {
        $titik = PetaTitik::findOrFail($id);
        $titik->is_wisata_unggulan = !$titik->is_wisata_unggulan;
        $titik->save();

        $status = $titik->is_wisata_unggulan ? 'ditambahkan ke' : 'dihapus dari';

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => "Toggle Unggulan Titik Peta: {$titik->nama} ({$status})",
        ]);

        return redirect()->back()
                         ->with('success', "Titik \"{$titik->nama}\" berhasil {$status} destinasi wisata unggulan!");
    }
}
