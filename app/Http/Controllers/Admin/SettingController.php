<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    /**
     * Whitelist key yang diperbolehkan diubah melalui form pengaturan.
     * Key di luar daftar ini akan ditolak untuk mencegah injection data sembarang.
     */
    private const ALLOWED_KEYS = [
        // Identitas Website
        'nama_desa',
        'nama_kecamatan',
        'nama_kabupaten',
        'nama_provinsi',
        'tagline',
        'deskripsi',
        'alamat',
        'email',
        'telepon',
        'whatsapp',
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        // Media & Tampilan
        'logo',
        'favicon',
        'hero_gambar',
        'hero_video',
        // Hero Sections
        'hero_beranda',
        'hero_profil',
        'hero_pemerintahan',
        'hero_wisata',
        'hero_produk',
        'hero_statistik',
        'hero_apbdes',
        'hero_berita',
        'hero_galeri',
        'hero_kontak',
        'hero_polling',
        // Backup & System (read-only, diatur oleh sistem)
        'last_backup',
    ];

    public function index()
    {
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        return view('admin.setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'telepon' => 'nullable|string|max:16|regex:/^\+?[0-9]{8,15}$/',
            'whatsapp' => 'nullable|string|max:16|regex:/^\+?[0-9]{8,15}$/',
        ]);

        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            // Tolak key yang tidak ada di whitelist
            if (!in_array($key, self::ALLOWED_KEYS)) {
                Log::warning('SettingController: percobaan set key tidak diizinkan.', [
                    'user_id'    => auth()->id(),
                    'ip'         => $request->ip(),
                    'key'        => $key,
                ]);
                abort(422, 'Konfigurasi tidak valid.');
            }

            if ($request->hasFile($key)) {
                $value = $request->file($key)->store('settings', 'public');
            }

            \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        \App\Models\ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'Update Pengaturan Web',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
