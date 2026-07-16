<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerangkatRtRw;
use Illuminate\Support\Facades\Storage;

class PerangkatRtRwController extends Controller
{
    public function index()
    {
        $data = PerangkatRtRw::orderBy('jenis')->orderBy('urutan')->get();
        $heroValue = \App\Models\Setting::where('key', 'hero_perangkat_rt_rw')->value('value');
        $hero = $heroValue
            ? json_decode($heroValue, true)
            : ['title' => 'Perangkat RT & RW', 'subtitle' => 'Daftar Ketua RT dan RW Desa Selorejo', 'icon' => 'map-pin'];
        return view('operator.pemerintahan.perangkat_rt_rw', compact('data', 'hero'));
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'title'    => 'required|string',
            'subtitle' => 'required|string',
            'icon'     => 'required|string',
        ]);

        \App\Models\Setting::updateOrCreate(
            ['key' => 'hero_perangkat_rt_rw'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );

        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header Perangkat RT & RW']);
        return back()->with('success', 'Banner header Perangkat RT & RW berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis'     => 'required|in:RT,RW',
            'nomor'     => 'required|integer|min:1',
            'nama'      => 'required|string|max:100',
            'dusun'     => 'required|string|max:100',
            'nomor_rt'  => 'nullable|integer|min:1',
            'nomor_rw'  => 'required|integer|min:1',
            'urutan'    => 'required|integer|min:0',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // RT wajib punya nomor_rt
        if ($validated['jenis'] === 'RT' && empty($validated['nomor_rt'])) {
            $validated['nomor_rt'] = $validated['nomor'];
        }

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('perangkat', 'public');
        }

        PerangkatRtRw::create($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Perangkat RT/RW: ' . $validated['jenis'] . ' ' . $validated['nomor'] . ' - ' . $validated['nama']]);
        return back()->with('success', 'Data ' . $validated['jenis'] . ' berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $perangkat = PerangkatRtRw::findOrFail($id);

        $validated = $request->validate([
            'jenis'     => 'required|in:RT,RW',
            'nomor'     => 'required|integer|min:1',
            'nama'      => 'required|string|max:100',
            'dusun'     => 'required|string|max:100',
            'nomor_rt'  => 'nullable|integer|min:1',
            'nomor_rw'  => 'required|integer|min:1',
            'urutan'    => 'required|integer|min:0',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($validated['jenis'] === 'RW') {
            $validated['nomor_rt'] = null;
        }

        if ($request->hasFile('foto')) {
            if ($perangkat->foto) {
                Storage::disk('public')->delete($perangkat->foto);
            }
            $validated['foto'] = $request->file('foto')->store('perangkat', 'public');
        }

        $perangkat->update($validated);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Perangkat RT/RW: ' . $validated['nama']]);
        return back()->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $perangkat = PerangkatRtRw::findOrFail($id);

        if ($perangkat->foto) {
            Storage::disk('public')->delete($perangkat->foto);
        }

        $perangkat->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Perangkat RT/RW']);
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
