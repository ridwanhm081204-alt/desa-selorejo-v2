<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\KknAnggota;
use App\Models\KknSetting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KknController extends Controller
{
    // ── Halaman utama: daftar anggota + tab settings ──
    public function index()
    {
        $anggota  = KknAnggota::orderBy('urutan')->get();
        $settings = KknSetting::all()->pluck('value', 'key');

        // Decode JSON values
        $decoded = [];
        foreach ($settings as $key => $value) {
            $arr = json_decode($value, true);
            $decoded[$key] = (json_last_error() === JSON_ERROR_NONE) ? $arr : $value;
        }

        return view('operator.kkn.index', compact('anggota', 'decoded'));
    }

    // ── Form tambah anggota ──
    public function create()
    {
        return view('operator.kkn.form-anggota');
    }

    // ── Simpan anggota baru ──
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:200',
            'nim'      => 'nullable|string|max:20',
            'prodi'    => 'nullable|string|max:200',
            'fakultas' => 'nullable|string|max:100',
            'foto'     => 'nullable|image|max:2048',
            'badge'    => 'nullable|in:ketua,developer',
            'proker'   => 'nullable|string|max:1000',
            'sdg'      => 'nullable|array',
            'sdg.*'    => 'integer',
            'urutan'   => 'nullable|integer',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kkn', 'public');
        }

        KknAnggota::create($data);
        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Anggota KKN: ' . $data['nama']]);

        return redirect('/operator/kkn')->with('success', 'Anggota KKN berhasil ditambahkan!');
    }

    // ── Form edit anggota ──
    public function edit($id)
    {
        $anggota = KknAnggota::findOrFail($id);
        return view('operator.kkn.form-anggota', compact('anggota'));
    }

    // ── Update anggota ──
    public function update(Request $request, $id)
    {
        $anggota = KknAnggota::findOrFail($id);

        $data = $request->validate([
            'nama'     => 'required|string|max:200',
            'nim'      => 'nullable|string|max:20',
            'prodi'    => 'nullable|string|max:200',
            'fakultas' => 'nullable|string|max:100',
            'foto'     => 'nullable|image|max:2048',
            'badge'    => 'nullable|in:ketua,developer',
            'proker'   => 'nullable|string|max:1000',
            'sdg'      => 'nullable|array',
            'sdg.*'    => 'integer',
            'urutan'   => 'nullable|integer',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika bukan path legacy (images/)
            if ($anggota->foto && !str_starts_with($anggota->foto, 'images/')) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $data['foto'] = $request->file('foto')->store('kkn', 'public');
        }

        $anggota->update($data);
        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Anggota KKN: ' . $anggota->nama]);

        return redirect('/operator/kkn')->with('success', 'Data anggota KKN berhasil diperbarui!');
    }

    // ── Hapus anggota ──
    public function destroy($id)
    {
        $anggota = KknAnggota::findOrFail($id);

        if ($anggota->foto && !str_starts_with($anggota->foto, 'images/')) {
            Storage::disk('public')->delete($anggota->foto);
        }

        $nama = $anggota->nama;
        $anggota->delete();
        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Anggota KKN: ' . $nama]);

        return redirect('/operator/kkn')->with('success', 'Anggota KKN berhasil dihapus.');
    }

    // ── Update settings KKN (DPL, badges, deskripsi, sosmed) ──
    public function updateSettings(Request $request)
    {
        $request->validate([
            'judul_utama'        => 'nullable|string|max:200',
            'subjudul'           => 'nullable|string|max:200',
            'kelompok_label'     => 'nullable|string|max:200',
            'tagline'            => 'nullable|string|max:500',
            'link_instagram'     => 'nullable|url|max:500',
            'link_tiktok'        => 'nullable|url|max:500',
            'badge_lokasi'       => 'nullable|string|max:200',
            'badge_periode'      => 'nullable|string|max:100',
            'badge_tema'         => 'nullable|string|max:200',
            'badge_anggota'      => 'nullable|string|max:200',
            'deskripsi_program'  => 'nullable|array',
            'deskripsi_program.*'=> 'nullable|string',
            'dpl_nama'           => 'nullable|string|max:200',
            'dpl_jabatan'        => 'nullable|string|max:200',
            'dpl_institusi'      => 'nullable|string|max:200',
            'dpl_foto'           => 'nullable|image|max:2048',
            'logo'               => 'nullable|image|max:2048',
        ]);

        $stringKeys = ['judul_utama', 'subjudul', 'kelompok_label', 'tagline',
                       'link_instagram', 'link_tiktok',
                       'badge_lokasi', 'badge_periode', 'badge_tema', 'badge_anggota'];

        foreach ($stringKeys as $key) {
            if ($request->filled($key)) {
                KknSetting::set($key, $request->input($key));
            }
        }

        // Deskripsi program (array paragraf)
        if ($request->has('deskripsi_program')) {
            $paragraf = array_filter($request->input('deskripsi_program'), fn($v) => !empty(trim($v)));
            KknSetting::set('deskripsi_program', array_values($paragraf));
        }

        // DPL
        $dpl = KknSetting::get('dpl', []);
        $dpl['nama']      = $request->input('dpl_nama', $dpl['nama'] ?? '');
        $dpl['jabatan']   = $request->input('dpl_jabatan', $dpl['jabatan'] ?? '');
        $dpl['institusi'] = $request->input('dpl_institusi', $dpl['institusi'] ?? '');

        if ($request->hasFile('dpl_foto')) {
            $old = $dpl['foto'] ?? null;
            if ($old && !str_starts_with($old, 'images/') && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $dpl['foto'] = $request->file('dpl_foto')->store('kkn', 'public');
        }
        KknSetting::set('dpl', $dpl);

        // Logo KKN
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('kkn', 'public');
            KknSetting::set('logo', $path);
        }

        ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings KKN']);

        return back()->with('success', 'Pengaturan halaman KKN berhasil disimpan!');
    }

    // ── Update urutan anggota (AJAX) ──
    public function reorder(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);
        foreach ($request->ids as $urutan => $id) {
            KknAnggota::where('id', $id)->update(['urutan' => $urutan + 1]);
        }
        return response()->json(['success' => true]);
    }
}
